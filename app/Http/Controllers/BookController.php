<?php

namespace App\Http\Controllers;

use App\Book;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->input('page', 1);
        $data = Book::paginate(5);
        $authors = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
                ->get()->pluck('name', 'id');
    
        return view('books.index', compact('data'), compact('authors'))
             ->with('i', ($page - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
                ->get()->pluck('name', 'id');
        return view('books.create', compact('authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'year' => ['required', 'string', 'max:4'],
            'author_id' => ['required'],
        ]);

        $book = Book::Create($request->all());
     
        return redirect()->route('books.index')
                         ->with('success', 'Книга успешно добавлена');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        $authors = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
                ->get()->pluck('name', 'id');
        return view('books.show', compact('book'), compact('authors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
                ->get()->pluck('name', 'id');
        return view('books.edit', compact('book'), compact('authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'name' => 'required',
            'year' => 'required',
            'author_id' => 'required',
        ]);
    
        $book->update($request->all());
    
        return redirect()->route('books.index')
                         ->with('success', 'Книга успешно обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
    
        return redirect()->route('books.index')
                         ->with('success', 'Книга успешно удалёна');
    }
}
