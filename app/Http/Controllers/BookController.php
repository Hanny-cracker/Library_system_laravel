<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BookController extends Controller
{
    private $search = null;
    /**
     * Display a listing of the book.
     */
    public function index()
    {
       
        return view('book.index');
    }

    public function books(){
         $books = Book::orderBy('tittle', 'asc')->paginate(8);
        return view('book.books', ['books'=>$books, 'search'=>$this->search]);
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('book.create', ['status' => BookStatus::asArray()]);
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tittle' => 'required|min:5|max:50',
            'author' => 'required',
            'description' => 'required|min:10',
            'quantity' => 'required',
            'available' => 'required| lte:quantity',
            'pages' => 'required',
            'language' => 'required',
            'publisher' => 'required',
            'published_at' => 'required',
            'status' => 'required',
        ]);
        try {
            $books = new Book(); 
            $faker = Faker::create();
            $books->tittle = $request->input('tittle'); 
            $books->author = $request->input('author');          
            $books->isbn = $faker->isbn13();
            $books->description = $request->input('description');
            $books->slug = Str::slug($request->input('tittle'));
            $books->quantity = $request->input('quantity');
            $books->available = $request->input('available');
            $books->pages = $request->input('pages');
            $books->language = $request->input('language');
            $books->publisher = $request->input('publisher');
            $books->published_at = $request->input('published_at');
            $books->status = $request->input('quantity') > 0 ? BookStatus::AVAILABLE : BookStatus::OUT_OF_STOCK;
            $books->save();
            
            return redirect('books')->with('success', 'Book added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified book.
     */
    public function show($slug)
    {
        try {
            $book = Book::where('slug', $slug)->first();
             return view('book.show', compact('book'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
       
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit($slug)
    {
        $book = Book::where('slug', $slug)->first();
        return view('book.edit', ['book' => $book, 'status' => BookStatus::asArray()]);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'tittle' => 'required|min:5|max:50',
            'author' => 'required',
            'description' => 'required|min:10',
            'quantity' => 'required ',
            'available' => 'required| lte:quantity',
            'pages' => 'required',
            'language' => 'required',
            'publisher' => 'required',
            'published_at' => 'required',
            // 'status' => 'required',
        ]);
        try {
            $books = Book::where('slug', $slug)->first();
            $faker = Faker::create();
            $books->tittle = $request->input('tittle'); 
            $books->author = $request->input('author');          
            $books->isbn = $faker->isbn13();
            $books->description = $request->input('description');
            $books->slug = Str::slug($request->input('tittle'));
            $books->quantity = $request->input('quantity');
            $books->available = $request->input('available');
            $books->pages = $request->input('pages');
            $books->language = $request->input('language');
            $books->publisher = $request->input('publisher');
            $books->published_at = $request->input('published_at');
            $books->status = $request->input('available') > 0 ? BookStatus::AVAILABLE : BookStatus::OUT_OF_STOCK;
            $books->save();
            
            return redirect('books')->with('success', 'Book updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy($id)
    {
        try {
            $Book = Book::find($id);
            $Book->delete();
            return redirect()->route('books');
        } catch (\Exception $th) {
            return redirect()->route('books')->with('fail', $th->getMessage());
        }
    }
    /**
     * Search for a book.
     */
    public function search(Request $request)
    {
        try {
            $search = $request->input('search');
            $books = Book::search($search)->paginate(8);
            return view('book.books', compact('books', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred');
        }
    }
}
