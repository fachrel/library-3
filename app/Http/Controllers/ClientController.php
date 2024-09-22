<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('client.home', compact('books'));
    }
    public function myBooks(){
        // $books = Book::all();
        return view('client.my-book');
    }
    public function bookmarks(){
        $bookmarks = Bookmark::where('user_id', Auth::user()->id)->get();
        return view('client.bookmark', compact('bookmarks'));
    }

    public function addBookmark($id){
        $check = Bookmark::where('user_id', Auth::user()->id)
                    ->where('book_id', $id)
                    ->first();
        if(!$check){
            Bookmark::create([
                'user_id' => Auth::user()->id,
                'book_id' => $id,
            ]);
            return redirect()->back()->with('success', 'buku berhasil ditambahkan ke koleksi buku.');
        }else{
            $check->delete();
            return redirect()->back()->with('success', 'buku dihapus dari koleksi buku.');
        }

    }
}
