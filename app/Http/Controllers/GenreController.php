<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Http\Requests\GenreRequest;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = request()->input('page', 1);
        $data = Genre::paginate(5);
    
        return view('genres.index', compact('data'))
             ->with('i', ($page - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genres.edit')
             ->with('genre', false)
             ->with('action', route('genres.store'))
             ->with('title', 'Добавить новый жанр');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenreRequest $request)
    {
        $validated = $request->validated();

        $genre = Genre::Create($request->all());
     
        return redirect()->route('genres.index')
                         ->with('message', 'Жанр успешно добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return view('genres.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'))
             ->with('action', route('genres.update', $genre->id))
             ->with('title', 'Редактировать жанр');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GenreRequest  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(GenreRequest $request, Genre $genre)
    {
        $validated = $request->validated();
    
        $genre->update($request->all());
    
        return redirect()->route('genres.index')
                         ->with('message', 'Жанр успешно обновлён');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
    
        return redirect()->route('genres.index')
                         ->with('message', 'Жанр успешно удалён');
    }
}
