<?php

namespace App\Http\Controllers;

use App\Enums\BookStatus;
use App\Models\BorrowedBook;
use Illuminate\Http\Request;
use App\Models\Book;

class BorrowedBookController extends Controller
{
    protected $search = null;
    //  Display a listing of the book.
    public function index()
    {
        try {
            $borrowedbooks = Borrowedbook::with('book')
                ->orderBy('name', 'asc')
                ->paginate(8);

            return view('borrowedbooks.index', ['borrowedbooks' => $borrowedbooks, 'search' => $this->search]);
        } catch (\Throwable $th) {
        }
    }

    // Show the form for creating a new book.
    public function create($slug)
    {
        try {
            $book = Book::where('slug', $slug)->first();
            return view('borrowedbooks.create', ['book' => $book]);
        } catch (\Exception $exception) {
            return redirect()->route('book.index')->with('error', 'Failed to borrow book.');
        }
    }

    // Store a newly created book in storage.
    public function borrow(Request $request, $slug)
    {
        $validated = $request->validate([
            'tittle' => 'min:5',
            'name' => 'required|min:5|max:20',
            'contact' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'quantity' => 'required|int',
            'notes' => 'required|min:10',
            'returned_at' => 'required',
        ]);

        try {
            $book = Book::where('slug', $slug)->first();
            $qnt = $book->quantity;
            $borrowedbook = new Borrowedbook();

            if ($request->input('quantity') <= $qnt) {
                $borrowedbook->name = $request->input('name');
                $borrowedbook->contact = $request->input('contact');
                $borrowedbook->address = $request->input('address');
                $borrowedbook->email = $request->input('email');
                $borrowedbook->slug = $slug;
                $borrowedbook->quantity = $request->input('quantity');
                $borrowedbook->notes = $request->input('notes');
                $borrowedbook->returned_at = $request->date('returned_at');
                $borrowedbook->book_id = $book->id;
                $borrowedbook->borrowed_at = now();
                $borrowedbook->save();

                $book->available -= $request->input('quantity');
                if ($book->available == 0) {
                    $book->status = BookStatus::OUT_OF_STOCK;
                }
                $book->save();

                return redirect()->route('borrowedbooks')->with('success', 'Book borrowed successfully.');
            }
            return redirect()->back()->with('error', 'Exceeded the quantity of books');
        } catch (\Exception $ex) {
            return redirect()->route('borrowedbooks')->with('error', $qnt . '' . $request->input('quantity') . 'THE ERROR' . $ex->getMessage());
        }
    }
    // Show the form for editing the specified book.
    public function edit($id)
    {
        try {
            $borrowedbook = Borrowedbook::where('id', $id)->first();
            $book = Book::where('id', $borrowedbook->book_id)->first();

            return view('borrowedbooks.edit', ['borrowedbook' => $borrowedbook, 'book' => $book]);
        } catch (\Exception $exception) {
            return redirect()->route('borrowedbooks.index')->with('error', 'Failed to edit book.');
        }
    }

    // Update the specified book in storage.
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tittle' => 'min:5',
            'name' => 'required|min:5|max:20',
            'contact' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'quantity' => 'required|int',
            'notes' => 'required|min:10',
            'returned_at' => 'required',
        ]);

        try {

            $borrowedbook = Borrowedbook::where('id', $id)->first();
            $book = Book::where('id', $borrowedbook->book_id)->first();
            $qnt = $book->quantity;


            if ($qnt >= $request->input('quantity')) {
                if (date($borrowedbook->borrowed_at) <= $request->date('returned_at')) {
                    $borrowedbook->name = $request->input('name');
                    $borrowedbook->contact = $request->input('contact');
                    $borrowedbook->address = $request->input('address');
                    $borrowedbook->quantity = $request->input('quantity');
                    $borrowedbook->email = $request->input('email');
                    $borrowedbook->returned_at = $request->date('returned_at');
                    $borrowedbook->save();
                    return redirect()->route('borrowedbooks')->with('success', 'Book updated successfully.');
                }
                return redirect()->back()->with('error', "The return date must be after ahead the borrowed date.");
            }
            return redirect()->back()->with('error', 'Exceeded the quantity of books');
        } catch (\Exception $exception) {
            return redirect()->route('borrowedbooks')->with('error', 'Failed to update book.');
        }
    }

    // Remove the specified book from storage.
    public function destroy($id)
    {
        try {
            $book = BorrowedBook::where('id', $id)->first();
            $book->delete();
            return redirect()->route('borrowedbooks')->with('success', 'Book deleted successfully.');
        } catch (\Exception $th) {
            return redirect()->back()->with('fail', 'Failed to delete book.');
        }
    }

    // Return a borrowed book.
    public function return($id)
    {
        try {
            $borrowedbook = Borrowedbook::where('id', $id)->first();
            $book = Book::where('id', $borrowedbook->book_id)->first();


            if ($book->available <= $book->quantity) {
                $book->available += $borrowedbook->quantity;
                if ($book->available > 0) {
                    $book->status = BookStatus::AVAILABLE;
                }
                $book->save();
                $this->destroy($id);
                return redirect()->back()->with('success', 'Book returned successfully');
            }
            return redirect()->back()->with('error', 'Exceeded the quantity of books');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', "Failed to return book.");
        }
    }

    public function search(Request $request)
    {
        try {

            $search = $request->input('search');            
            $borrowedbooks = Borrowedbook::search($search)->paginate(8);
            return view('borrowedbooks.index', compact('borrowedbooks','search'));
        } catch (\Exception $exception) {
            return redirect()->route('borrowedbooks.index')->with('error', 'Failed to search book.');
        }
    }
}
