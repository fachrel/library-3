<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        $categories = Category::all();
        return view('server.books', compact('books', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        $validated = $request->validated();

        $path = null;
        if($validated['photo']){
            $path = $validated['photo']->store('books', 'public');
        }

        $validated['photo'] = $path;

        $book = Book::create($validated);

        $book->categories()->sync($validated['categories']);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookRequest $request, string $id)
    {
        $validated = $request->validated();
        $book = Book::findOrFail($id);

        if ($request->hasFile('photo')) {
            $filePath = storage_path('app/public/' . $book->photo);
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            $book->photo = $request->file('photo')->store('books', 'public');
        }
        $book->update($request->only(['name', 'author', 'publisher', 'year', 'quantity']));
        $book->categories()->sync($validated['categories']);

        return redirect()->back()->with('success', value: 'Buku berhasil diedit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrfail($id);
        $book->categories()->detach();
        Storage::disk('public')->delete($book->photo);
        $book->delete();

        return redirect()->back()->with('success', 'Buku Berhasil dihapus!');

    }
}
