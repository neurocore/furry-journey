<?php

namespace App\Http\Controllers;

use App\User;
use App\Genre;
use App\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        $data = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
             ->withCount(['books'])
             ->get();

        // dd($data);

        return view('author.users', compact('data'))->with('i', 0);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genres()
    {
        $data = Genre::get();
    
        return view('author.genres', compact('data'))->with('i', 0);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function books()
    {
        $data = Book::get();
        $authors = User::whereHas('roles', function($q) { $q->where('name', 'author'); })
                ->get()->pluck('name', 'id');
    
        return view('author.books', compact('data'), compact('authors'))->with('i', 0);
    }
}
