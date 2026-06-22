<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
use App\Models\StaffMember;

class FrontController extends Controller
{
    
    public function index()
    {   
        $categories = DB::table('categories')->get();
        $books = DB::table('books')->orderBy('id', 'DESC')->get();
        return $this->frontend_construct('index', ['books' => $books,'categories' => $categories]);
    }

    public function about()
    {
        $about = DB::table('about_pages')->first();
        $staffMembers = StaffMember::active()->ordered()->get();

        return $this->frontend_construct('pages/about', [
            'about' => $about,
            'staffMembers' => $staffMembers,
        ]);
    }

    public function checkout()
    {
        return $this->frontend_construct('pages/checkout');
    }

    public function contact()
    {
        return $this->frontend_construct('pages/contact');
    }

    public function faq()
    {
        return $this->frontend_construct('pages/faq');
    }

    public function news_details()
    {
        return $this->frontend_construct('pages/news-details');
    }

    public function news_grid()
    {
        return $this->frontend_construct('pages/news-grid');
    }

    public function news()
    {
        return $this->frontend_construct('pages/news');
    }

    public function shop_cart()
    {
        return $this->frontend_construct('pages/shop_cart');
    }

    public function shop_details($slug)
    {
        
        $book_detail = DB::table('books')->where('slug', $slug)->first(); 
        $relate_book =  DB::table('books')->where('category_id', $book_detail->category_id)->where('id','!=', $book_detail->id)->get();
        return $this->frontend_construct('pages/shop-details', ['book' => $book_detail, 'relate_books' => $relate_book]);
    }

    public function shop_list()
    {
        return $this->frontend_construct('pages/shop-list');
    }

    public function shop(Request $request)
    {
        $categories = DB::table('categories')->get();
       
        $filters =  [
            'query' => $request->query('query') ?? '',
            'category' => $request->query('category'),
        ];
        
        return $this->frontend_construct('pages/shop', ['filters' => $filters, 'categories' => $categories]);
    }

    public function team_details()
    {
        return $this->frontend_construct('pages/team_details');
    }

    public function team()
    {
        return $this->frontend_construct('pages/team');
    }

    public function wishlist()
    {
        return $this->frontend_construct('pages/wishlist');
    }

    public function search(Request $request)
    {
        
        $search = $request->query('search', '');
        $category = $request->query('category', '');
        // $brands = $request->query('brands', '');

        $query = DB::table('books')
            ->join('categories as c', 'books.category_id', '=', 'c.id')
            ->select('books.*', 'c.name', 'c.id');
            // ->leftJoin('category_langs as cl', 'books.category_lang_id', '=', 'cl.id');

        if (!empty($search)) {
            $query->where('title', 'LIKE', "%{$search}%");
        }

        if (!empty($category)) {
            $query->where('c.id', $category);
        }

        $books =  $query->paginate(50);

        if($books) {

            $data =  $books;
        } else {
            $data =  0;
        }
        
        return response()->json($data);
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject', 'Contact Form Inquiry'),
            'message' => $request->input('message'),
        ]);

        return redirect()->back()->with('success', __('message.contact_sent_success'));
    }
}
