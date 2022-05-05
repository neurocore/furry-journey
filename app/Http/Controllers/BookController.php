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
        return view('books.create', compact('authors'), compact('genres'))
             ->with('book', false)
             ->with('action', route('books.store'))
             ->with('title', 'Добавить новую книгу');
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

        $user = User::find($request->input('author_id'));
        if ($user === null)                    return $this->failure('Пользователя не существует!');
        if ($user->hasRole('author') === null) return $this->failure('Пользователь не является автором!');

        $genre_ids = $request->input('genre_ids');
        foreach ($genre_ids as $genre_id)
            if (Genre::find($genre_id) === null)
                return $this->failure('Такого жанра не существует!');

        $book = Book::Create($request->all());

        $book->genres()->detach();
        $book->genres()->attach($genre_ids);
     
        return $this->success('Книга успешно добавлена');
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
             ->with(compact('authors'))
             ->with('action', route('books.update', $book->id))
             ->with('title', 'Редактировать книгу');
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

        $user = User::find($request->input('author_id'));
        if ($user === null)                    return $this->failure('Пользователя не существует!');
        if ($user->hasRole('author') === null) return $this->failure('Пользователь не является автором!');

        $genre_ids = $request->input('genre_ids');
        foreach ($genre_ids as $genre_id)
            if (Genre::find($genre_id) === null)
                return $this->failure('Такого жанра не существует!');
    
        $book->update($request->all());

        $book->genres()->detach();
        $book->genres()->attach($genre_id);
    
        return $this->success('Книга успешно обновлена');
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
    
        return $this->success('Книга успешно удалёна');
    }

    /**
     * Build successful redirect to index page.
     * 
     * @param string $message
     * @return \Illuminate\Support\Facades\Redirect
     */
    private function success(string $message)
    {
        return redirect()->route('books.index')
                         ->with('message', $message);
    }

    /**
     * Build unsuccessful redirect to index page.
     * 
     * @param string $message
     * @return \Illuminate\Support\Facades\Redirect
     */
    private function failure(string $message)
    {
        return redirect()->route('books.index')
                         ->with('status', 'danger')
                         ->with('message', $message);
    }
}
