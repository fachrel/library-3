<?php

use App\Models\Loan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

// Route::get('/po', action: function () {
//     $loans = Loan::all();
//     return view('printout', compact('loans'));
// });

// authentication
route::get( '/login', [AuthController::class, 'login'])->name('login');
route::post( '/login', [AuthController::class, 'authenticate']);

route::get( '/register', [AuthController::class, 'register'])->name('register');
Route::post( '/register', [AuthController::class, 'store'])->name('register.store');

route::get( '/logout', [AuthController::class, 'logout'])->name('logout');

// client all role
Route::get('/', action: [ClientController::class, 'index'])->name('home');
// client user role only
route::middleware(['auth', 'role:user'])->group(function (){
    Route::get('/books/{id}', [ClientController::class, 'bookDetail'])->name('book.detail');
    Route::get('/my-books', action: [ClientController::class, 'myBooks'])->name('my.books');
    Route::get('/bookmarks', action: [ClientController::class, 'bookmarks'])->name('bookmarks');
    Route::get('/bookmarks/add/{id}', action: [ClientController::class, 'addBookmark'])->name('add.bookmark');

    Route::post('/review/add/{id}', action: [ClientController::class, 'addReview'])->name('add.review');

});

// admin
route::middleware(['auth', 'role:admin,operator'])->group(function (){
    route::get( '/dashboard', [ServerController::class, 'index'])->name('dashboard');
    route::post( '/po', [TransactionController::class, 'print'])->name('po');

    route::resource( '/dashboard/users', UserController::class);
    route::get( '/dashboard/users/search', action: [ServerController::class, 'searchUser'])->name('users.search');
    route::resource( '/dashboard/categories', CategoryController::class);
    route::resource( '/dashboard/books', BookController::class);

    route::get( '/dashboard/loan', [TransactionController::class, 'loan'])->name('loan');
    route::post( '/dashboard/loan/select-user', [TransactionController::class, 'selectUser'])->name('loan.select.user');
    route::get( '/dashboard/loan/add-book/{id}', [TransactionController::class, 'addBookToCart'])->name('add.book');
    route::get( '/dashboard/loan/remove-book/{id}', [TransactionController::class, 'removeBookFromCart'])->name(name: 'remove.book');
    route::get( '/dashboard/loan/remove-all-books', [TransactionController::class, 'removeAllBooksFromCart'])->name(name: 'remove.all.books');
    route::get( '/dashboard/loan/borrow-book', [TransactionController::class, 'borrowBook'])->name(name: 'borrow.book');

    route::get( '/dashboard/return', [TransactionController::class, 'return'])->name('return');
    route::get( '/dashboard/return/detail/{id}', [TransactionController::class, 'returnDetail'])->name('return.detail');
    Route::post('/dashboard/return/{id}', [TransactionController::class, 'returnBook'])->name('return.book');

});
