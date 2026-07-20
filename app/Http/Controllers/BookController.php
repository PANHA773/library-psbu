<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Imports\BookImport;
use Illuminate\Routing\Controllers\Middleware;


class BookController extends Controller
{
    private function isDepartmentUser()
    {
        return auth()->check() && auth()->user()->user_type === 'department';
    }

    private function canManageBook($book)
    {
        if (!auth()->check()) {
            return false;
        }

        if (auth()->user()->hasAnyRole(['Owner', 'Admin', 'Teacher'])) {
            return true;
        }

        if ($this->isDepartmentUser()) {
            return $book && (int) $book->created_by === (int) auth()->id();
        }

        return false;
    }

        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher|Department'),
                new Middleware('permission:book-index', only: ['index']),
                new Middleware('permission:book-create', only: ['create','store']),
                new Middleware('permission:book-edit', only: ['edit','update']),
                new Middleware('permission:book-delete', only: ['destroy']),
                new Middleware('permission:book-view', only: ['show']),
                new Middleware('permission:book-print_barcodes', only: ['print_barcodes']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        // dd('he');
        if (!auth()->user()->can('book-index')) {
            return redirect()->back()->with('error', 'You do not have permission!');
        }
        $booksQuery = DB::table('books')
            ->leftJoin('categories as c', 'books.category_id', '=', 'c.id')
            ->leftJoin('category_langs as cl', 'books.category_lang_id', '=', 'cl.id')
            ->leftJoin('departments as d', 'books.department_id', '=', 'd.id')
            ->orderBy('books.id', 'desc')
            ->select('books.*', 'c.name as category_name', 'cl.name as cate_lang_name', 'd.name as department_name');
        
        // Department users should see their own uploads and books in their department
        if ($this->isDepartmentUser() && !auth()->user()->hasAnyRole(['Owner', 'Admin'])) {
            $booksQuery->where(function ($query) {
                $query->where('books.created_by', auth()->id())
                    ->orWhere('books.department_id', auth()->user()->department_id);
            });
        }
        
        $books = $booksQuery->paginate(25);
        return $this->admin_construct('books.index', ['books' => $books]);
    }

    public function create()
    {
        $categories =  DB::table('categories')->get();
        $category_languages = DB::table('category_langs')->get();
        $departmentsQuery = DB::table('departments')->where('is_active', true);

        if (auth()->user()->department_id && !auth()->user()->hasAnyRole(['Owner', 'Admin'])) {
            $departmentsQuery->where('id', auth()->user()->department_id);
        }

        $departments = $departmentsQuery->get();
        return $this->admin_construct('books.add', ['categories' => $categories, 'category_languages' => $category_languages, 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'code' => 'nullable|string|max:255',
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',
        ]);

        $data =  [
            'code' => $request->code ?: reference_no('book', 10),
            'title' => $request->title,
            'slug' => str_replace(' ', '_', $request->title),
            'author' => $request->author_name,
            'author_date' => $request->author_date,
            'category_lang_id' => $request->category_lang_id,
            'category_id' => $request->category,
            'department_id' => $request->department_id,
            'pdf_downloadable' => $request->has('pdf_downloadable') ? 1 : 0,
            'created_by' => Auth::user()->id,
            'created_at' => now()->format('Y-m-d H:i:s'),
            'details' => clear_tag($request->description),
        ];

        if (auth()->user()->department_id && !auth()->user()->hasAnyRole(['Owner', 'Admin'])) {
            $data['department_id'] = auth()->user()->department_id;
        }

        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', time()) . '.' . $extension;
            $file->move(public_path('uploads/books/'), $filename);
            $data['image'] = $filename;
        }

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', time()) . '.' . $extension;
            $file->move(public_path('uploads/books/pdfs/'), $filename);
            $data['pdf'] = $filename;
        }

        DB::table('books')->insert($data);

        return admin_redirect('group_book/books')->with('success', __('message.book_added'));
    }

    public function show($id)
    {
        $book =  DB::table('books')->where('id', $id)->first();
        return response()->json($book);
    }

    public function get_book_data($term)
    {

        $b = [];
        $rows = DB::table('books')
            ->where('code', 'LIKE', "%{$term}%")
            ->orWhere('title', 'LIKE', "%{$term}%")
            ->get();

        if (!empty($rows)) {
            $r = 0;
            foreach ($rows as $row) {
                unset($row->created_by, $row->created_at, $row->updated_at, $row->details, $row->slug, $row->views, $row->author, $row->author_date, $row->category_lang_id, $row->category_id);
                $c = uniqid(mt_rand(), true);
                $row->qty = 1;
                $b[] = ['id' => sha1($c . $r), 'item_id' => $row->id, 'label' => $row->title . ' (' . $row->code . ')', 'row' => $row];
                $r++;
            }
        }

        if ($b) {
            return response()->json($b);
        } else {
            return response()->json([['id' => 0, 'label' => __('message.no_match_found')]]);
        }
    }

    public function edit($id)
    {
        $book = DB::table('books')
            ->where('id', $id)
            ->select('*')->first();

        // Department users can only edit the books they uploaded
        if ($this->isDepartmentUser() && !$this->canManageBook($book)) {
            return redirect()->back()->with('error', 'You do not have permission to edit this book!');
        }
        
        // get categories
        $categories = DB::table('categories')->get();
        $category_languages = DB::table('category_langs')->get();
        $departmentsQuery = DB::table('departments')->where('is_active', true);

        if (auth()->user()->department_id && !auth()->user()->hasAnyRole(['Owner', 'Admin'])) {
            $departmentsQuery->where('id', auth()->user()->department_id);
        }

        $departments = $departmentsQuery->get();

        return $this->admin_construct('books.edit', ['book' => $book, 'categories' => $categories, 'category_languages' => $category_languages, 'departments' => $departments]);
    }

    public function update(Request $request, $id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        // Department users can only update the books they uploaded
        if ($this->isDepartmentUser() && !$this->canManageBook($book)) {
            return admin_redirect('group_book/books')->with('error', 'You do not have permission to update this book!');
        }

        $request->validate([
            'code' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10240',

        ]);

        $data =  [
            'code' => strtolower(str_replace(' ', '_', $request->code)),
            'title' => $request->title,
            'slug' => strtolower(str_replace(' ', '_', $request->slug)),
            'author' => $request->author_name,
            'author_date' => $request->author_date,
            'category_lang_id' => $request->category_lang_id,
            'category_id' => $request->category,
            'department_id' => $request->department_id,
            'pdf_downloadable' => $request->has('pdf_downloadable') ? 1 : 0,
            'updated_at' => now()->format('Y-m-d H:i:s'),
            'details' => clear_tag($request->description),
        ];

        if (auth()->user()->department_id && !auth()->user()->hasAnyRole(['Owner', 'Admin'])) {
            $data['department_id'] = auth()->user()->department_id;
        }

        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', time()) . '.' . $extension;
            $file->move(public_path('uploads/books/'), $filename);
            $data['image'] = $filename;

            $old_img = DB::table('books')->where(['id' => $id])->first()->image;
            if ($old_img && file_exists(public_path('uploads/books/' . $old_img))) {
                unlink(public_path('uploads/books/' . $old_img));
            }
        }

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $extension = $file->getClientOriginalExtension();
            $filename = hash('gost', time()) . '.' . $extension;
            $file->move(public_path('uploads/books/pdfs/'), $filename);
            $data['pdf'] = $filename;

            $old_pdf = DB::table('books')->where(['id' => $id])->first()->pdf;
            if ($old_pdf && file_exists(public_path('uploads/books/pdfs/' . $old_pdf))) {
                unlink(public_path('uploads/books/pdfs/' . $old_pdf));
            }
        }

        DB::table('books')
            ->where('id', $id)
            ->update($data);

        return admin_redirect('group_book/books')->with('success', __('message.book_updated'));
    }

    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        
        // Department users can only delete the books they uploaded
        if ($this->isDepartmentUser() && !$this->canManageBook($book)) {
            return admin_redirect('group_book/books')->with('error', 'You do not have permission to delete this book!');
        }

        if (DB::table('book_borrowers')->where('book_id', $id)->first()) {
            return admin_redirect('group_book/books')->with('error', __('message.this_book_can_not_delete_please_check_book_browers'));
        } else {
            $old_img =  DB::table('books')->where(['id' => $id])->first()->image;
            $old_pdf =  DB::table('books')->where(['id' => $id])->first()->pdf;
            DB::table('books')->where(['id' => $id])->delete();
            if ($old_img && file_exists(public_path('uploads/books/' . $old_img))) {
                unlink(public_path('uploads/books/' . $old_img));
            }
            if ($old_pdf && file_exists(public_path('uploads/books/pdfs/' . $old_pdf))) {
                unlink(public_path('uploads/books/pdfs/' . $old_pdf));
            }
        }

        return admin_redirect('group_book/books')->with('success', __('message.book_deleted'));
    }

    public function print_barcodes(Request $request)
    {
        $barcodes = [];
        $site_name = 0;
        $product_name = 0;
        $product_price = 0;

        if ($request->form_type) {

            $s = $request->book_id ? sizeof($request->book_id) : 0;

            $site_name = $request->site_name ? $request->site_name : 0;
            $product_name = $request->product_name ? $request->product_name : 0;
            $product_price = $request->product_price ? $request->product_price : 0;

            for ($m = 0; $m < $s; $m++) {
                $bid =  $request->input('book_id')[$m];
                $quantity =  $request->input('quantity')[$m];

                $book = DB::table('books')->where('id', $bid)->first();

                $barcodes[] = [
                    'book_id'   => $book->id,
                    'barcode'   =>  $book->code,
                    'book_name' => $book->title,
                    'quantity'  => $quantity,
                    'price'     => $book->price,
                    'barcode_symbol' => $book->barcode_symbol,
                ];
            }
        }
        return $this->admin_construct('books.barcodes', ['barcodes' => $barcodes, 'site_name' => $site_name,'product_name' => $product_name, 'product_price' => $product_price]);
    }

    public function import()
    {
        return $this->admin_construct('books.import');
    }

    public function import_by_csv(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:csv,xls,xlsx|max:10240',
        ]);

        Excel::import(new BookImport, $request->file('import_file'));

        return admin_redirect('group_book/books')->with('success', __('message.import_book_success'));
    }
}
