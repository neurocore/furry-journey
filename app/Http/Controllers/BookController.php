<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
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
        $data = Book::with(['author', 'genres'])->paginate(5);
    
        return view('books.index', compact('data'))
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
        $genres = Genre::get()->pluck('name', 'id');
        return view('books.create', compact('authors'), compact('genres'));
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
            'year' => ['required', 'numeric'],
            'author_id' => ['required'],
        ]);

        $book = Book::Create($request->all());
        $genre_id = $request->input('genre_id');
        $book->genres()->detach();
        $book->genres()->attach($genre_id);
     
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

        $book_genres = $book->genres->pluck('name', 'id');
        $genres = Genre::get()
               ->pluck('name', 'id')
               ->map(function ($item, $key) use ($book_genres) {
                    return [
                        'name' => $item,
                        'checked' => isset($book_genres[$key]),
                    ];
        });

        return view('books.edit')
             ->with(compact('book'))
             ->with(compact('genres'))
             ->with(compact('authors'));
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

        $genre_id = $request->input('genre_id');
        $book->genres()->detach();
        $book->genres()->attach($genre_id);
    
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
