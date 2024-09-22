<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use App\Models\LoanDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function loan(){
        $books = Book::all();
        $users = User::where('role', '0')->get();
        return view( 'server.loan', compact('books', 'users'));
    }

    public function selectUser(Request $request){
        $user = User::findOrFail($request->user);

        session()->put('selectedUser', [
            'id' => $user->id,
            'name' => $user->name,
            'username' => $user->username,
        ]);

        return redirect()->back()->with('success', 'Peminjam berhasil dipilih');
    }

    public function addBookToCart($id){
        $book = Book::findOrFail($id);
        $cart = session()->get('cart', []);
        $user = session()->get('selectedUser');

        if(!$user || empty($user)){
            return redirect()->back()->with('error', 'Pilih peminjam sebelum memilih buku.');
        }

        if($book->quantity - $book->CountBorrowedBook() < 1){
            return redirect()->back()->with('error', 'Stock buku yang anda pilih habis.');
        }

        if($book->isBookBorrowed($user['id'])){
            return redirect()->back()->with('error', 'Buku sedang dipinjam dan belum dikembalikan.');
        }

        if(isset($cart[$id])){
            return redirect()->back()->with('error', 'Buku sudah ditambahkan.');
        }else{
            $cart[$id] = [
                "id" => $book->id,
                "name" => $book->name,
                "author" => $book->author,
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Buku berhasil ditambahkan.');
    }

    public function removeBookFromCart($id){

        if($id){
            $cart = session()->get('cart', []);
            if(isset($cart[$id])){
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Buku berhasil dihapus.');
        }

    }

    public function borrowBook(){
        $user = session()->get('selectedUser');
        $cart = session()->get('cart');

        if(!$user || empty($user)){
            return redirect()->back()->with('error', 'Pilih peminjam sebelum melakukan peminjaman.');
        }

        if(!$cart || empty($cart)){
            return redirect()->back()->with('error', 'Pilih buku sebelum melakukan peminjaman.');
        }

        $loan = Loan::create([
            'invoice' => 'INV-' . now()->format('Ymd') . '-' . $user['id'] .'-'. str_pad(count($cart), 3, "0", STR_PAD_LEFT),
            'user_id' => $user['id'],
            'borrowed_at' => now(),
            'must_returned_at' => now()->addDays(7),
        ]);

        $loan_id = $loan->id;

        foreach($cart as $item){
            LoanDetail::create([
                'loan_id' => $loan_id,
                'book_id' => $item['id'],
                'invoice' => 'INV-' . now()->format('Ymd') . '-' . $user['id'] .'-'. str_pad($item['id'], 3, "0", STR_PAD_LEFT),
                'status' => '1',
                'returned_at' => null
            ]);
        }

        session()->forget('cart');
        session()->forget('selectedUser');
        return redirect()->back()->with('success', 'Peminjaman berhasil.');

    }

    public function removeAllBooksFromCart(){
        session()->forget('cart');
        return redirect()->back()->with('success', 'Semua buku berhasil dihapus.');
    }

    public function return(){
        $loans = Loan::all();
        return view('server.return', compact('loans'));
    }
}
