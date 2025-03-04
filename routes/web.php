<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowedBookController;

// Route::get('/', function () {
//     return view('welcome');
// });



Auth::routes();
Route::middleware(['auth'])->group(function () {
   Route::get('/', [BookController::class, 'index'])->name('home');
   Route::get('/books', [BookController::class, 'books'])->name('books');
   Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
   Route::get('/books/search', [BookController::class, 'search'])->name('book.search');
   Route::post('/books/store', [BookController::class, 'store'])->name('book.store');
   Route::get('/books/{id}', [BookController::class, 'show'])->name('book.show');
   Route::get('/books/{slug}/edit', [BookController::class, 'edit'])->name('book.edit');
   Route::post('/books/update/{slug}', [BookController::class, 'update'])->name('book.update');
   Route::delete('/books/{slug}', [BookController::class, 'destroy'])->name('book.delete');
   Route::get('/books/{slug}/borrow', [BookController::class, 'borrow'])->name('book.borrow');
  
   Route::get('/borrowedbooks', [BorrowedBookController::class, 'index'])->name('borrowedbooks');
   Route::get('/borrowedbooks/{slug}/create', [BorrowedBookController::class, 'create'])->name('borrowedbook.create');
   Route::get('/borrowedbooks/search', [BorrowedBookController::class, 'search'])->name('borrowedbook.search');
   Route::post('/borrowedbooks/{id}/store', [BorrowedBookController::class, 'borrow'])->name('borrowedbook.store');
   Route::get('/borrowedbooks/{id}/edit', [BorrowedBookController::class, 'edit'])->name('borrowedbook.edit');
   Route::post('/borrowedbooks/update/{slug}', [BorrowedBookController::class, 'update'])->name('borrowedbook.update');
   Route::delete('/borrowedbooks/{id}/delete', [BorrowedBookController::class, 'destroy'])->name('borrowedbook.delete');
   Route::get('/borrowedbooks/{slug}/return', [BorrowedBookController::class, 'return'])->name('borrowedbook.return');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
