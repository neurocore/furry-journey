<?php

use App\User;
use App\Book;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// (-) 3.1. User authorization request



// (+) 3.2. Getting books by author

Route::get('/books', function(Request $request) {
    return Book::with(['authors'])->get();
});

// (+) 3.3. Getting book by id

Route::get('/books/{id}', function($id) {
    return Book::findOrFail($id);
});

// (-) 3.4. Updating book by id ------------------- [auth required]

Route::put('/books/{id}', function(Request $request, $id) {
    $book = Book::findOrFail($id);
    $book->update($request->all());

    return $book;
});

// (-) 3.5. Deleting book by id ------------------- [auth required]

Route::delete('/books/{id}', function($id) {
    Book::findOrFail($id)->delete();

    return 204;
});

// (+) 3.6. Getting authors list with books count

Route::get('/authors', function() {
    return User::whereHas('roles', function($q) { $q->where('name', 'author'); })
             ->withCount(['books'])->get();
});

// (+) 3.7. Getting author info with books list

Route::get('/authors/{id}', function($id) {
    $user = User::findOrFail($id);

    return $user->hasRole('author')
         ? $user->with(['books'])->get()
         : App::abort(404);
});

// (-) 3.8. Updating author info ------------------ [auth required]

Route::put('/books/{id}', function(Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update($request->all());

    return $user;
});
