<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Routing\Controllers\Middleware;

class BorrowerController extends Controller
{
        public function middleware($middleware = null, array $options = [])
    {
        if (func_num_args() === 0) {
            return [
                new Middleware('role:Owner|Admin|Teacher'),
                new Middleware('permission:borrower-index', only: ['index']),
                new Middleware('permission:borrower-create', only: ['create','store']),
                new Middleware('permission:borrower-edit', only: ['edit','update']),
                new Middleware('permission:borrower-delete', only: ['destroy']),
                new Middleware('permission:borrower-borrowed', only: ['borrowed']),
                new Middleware('permission:borrower-repay', only: ['repayed']),
                new Middleware('permission:borrower-view', only: ['show']),
            ];
        }

        return parent::middleware($middleware, $options);
    }

    public function index()
    {
        $books = DB::table('borrowers')
            ->orderBy('id', 'desc')
            ->get();
        return $this->admin_construct('borrow.index', ['borrowings' => $books]);
    }

    public function create()
    {
        $books =  DB::table('books')->get();
        $students = DB::table('students')->get();
        return $this->admin_construct('borrow.add', ['students' => $students]);
    }

    public function get_data($term)
    {
        $pr = [];
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
                $pr[] = ['mt_rand' => mt_rand(), 'id' => sha1($c . $r), 'item_id' => $row->id, 'label' => $row->title . ' (' . $row->code . ')', 'row' => $row];
                $r++;
            }
        }

        if ($pr) {
            return response()->json($pr);
        } else {
            return response()->json([['id' => 0, 'label' => __('message.no_match_found')]]);
        }
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'student_id' => 'required',
        ]);

        $data =  [
            'reference_no'  => reference_no('borrow', 10),
            'start_date'    => $request->date,
            'student_id'    => $request->student_id,
            'created_by'    => Auth::user()->id,
            'status'        => 'pending',
            'created_at'    => Carbon::now(),
            'note'          => clear_tag($request->description),
        ];

        $id = DB::table('borrowers')->insertGetId($data);
        $book_borrow =  [];

        for ($i = 0; $i < count($request->book_id); $i++) {
            $book_borrow['borrower_id'] = $id;
            $book_borrow['book_id'] = $request->book_id[$i];
            $book_borrow['book_code'] = $request->book_code[$i];
            $book_borrow['book_name'] = $request->book_name[$i];
            $book_borrow['quantity'] = $request->quantity[$i];
            DB::table('book_borrowers')->insert($book_borrow);
        }

        session(['remove_br' => 1]);
        return admin_redirect('borrowers')->with('success', __('message.book_borrower_added'));
    }

    public function show($id)
    {
        $borrower       = DB::table('borrowers')
            ->join('students', 'borrowers.student_id', '=', 'students.id')
            ->where('borrowers.id', $id)
            ->select('students.*', 'borrowers.reference_no', 'borrowers.status', 'borrowers.start_date', 'borrowers.end_date')
            ->first();
        $book_borrow    = DB::table('book_borrowers')
            ->join('books', 'book_borrowers.book_id', '=', 'books.id')
            ->where('book_borrowers.borrower_id', $id)
            ->select("books.*", 'book_borrowers.quantity as borrow_quantity')
            ->get();

        return response()->json(['borrow' => $borrower, 'books' => $book_borrow]);
    }

    public function edit($id)
    {
        $borrow = DB::table('borrowers')->where(['id' => $id])->select("*")->first();
        $book_borrow = DB::table('book_borrowers')
            ->join('books', 'books.id', '=', 'book_borrowers.book_id')
            ->where(['book_borrowers.borrower_id' => $borrow->id])
            ->select('books.*')
            ->get();

        $pr =  [];

        $c = rand(100000, 9999999);
        if (!empty($book_borrow)) {

            foreach ($book_borrow as $row) {
                $row->qty = 1;
                $row->details = strip_tags(decode_html($row->details));
                $ri = $row->id;
                $pr[$ri] = ['id' => $c, 'item_id' => $row->id, 'label' => $row->title . ' (' . $row->code . ')', 'row' => $row];
                $c++;
            }
        }

        $data = json_encode($pr);
        $students = DB::table('students')->get();
        return $this->admin_construct('borrow.edit', ['id' => $id, 'borrow' => $borrow, 'book_borr' => $data, 'students' => $students]);
    }

    public function update(Request $request, $id)
    {

        $valid = $request->validate([
            'student_id' => 'required',
        ]);

        $data =  [
            'reference_no'  => $request->reference_no,
            'start_date'    => $request->date,
            'student_id'    => $request->student_id,
            'created_by'    => Auth::user()->id,
            'status'        => 'pending',
            'note'          => clear_tag($request->description),
        ];

        DB::table('borrowers')->where('id', $id)->update($data);
        DB::table('book_borrowers')->where('borrower_id', $id)->delete();
        $book_borrow =  [];
        for ($i = 0; $i < count($request->book_id); $i++) {
            $book_borrow['borrower_id'] = $id;
            $book_borrow['book_id'] = $request->book_id[$i];
            $book_borrow['book_code'] = $request->book_code[$i];
            $book_borrow['book_name'] = $request->book_name[$i];
            $book_borrow['quantity'] = $request->quantity[$i];
            DB::table('book_borrowers')->insert($book_borrow);
        }

        session(['remove_br' => 1]);
        return admin_redirect('borrowers')->with('success', __('message.book_borrower_updated'));
    }

    public function destroy($id)
    {
        if(DB::table('borrowers')->where('id', $id)->first()->status == 'borrowed') {
            return admin_redirect('borrowers')->with('error', __('message.book_borrowed_can_not_delete'));
        } else {
             DB::table('borrowers')->where('id', $id)->delete();
             DB::table('book_borrowers')->where('borrower_id', $id)->delete();
        }

        return admin_redirect('borrowers')->with('success', __('message.book_borrower_deleted'));
    }

    public function borrowed($id)
    {
        DB::table('borrowers')->where('id', $id)->update(['status' => 'borrowed']);
        return admin_redirect('borrowers')->with('success', __('message.book_has_been_borrowed'));
    }

    public function repayed($id)
    {
        DB::table('borrowers')->where('id', $id)->update(['status' => 'repayed', 'end_date' => date('Y-m-d')]);
        return admin_redirect('borrowers')->with('success', __('message.books_has_been_repayed'));
    }
}
