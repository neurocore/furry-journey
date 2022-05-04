<?php

use App\User;
use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;

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

// + 3a) User authorization request

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// + 3b) Getting books by authors name

Route::get('/books', function(Request $request) {
    return Book::with(['authors'])->get();
});

// + 3c) Getting book by id

Route::get('/books/{id}', function($id) {
    return Book::findOrFail($id);
});

// + 3f) Getting authors list with books count

Route::get('/authors', function() {
    return User::whereHas('roles', function($q) { $q->where('name', 'author'); })
             ->withCount(['books'])->get();
});

// + 3g) Getting author info with books list

Route::get('/authors/{id}', function($id) {
    $user = User::findOrFail($id);

    return $user->hasRole('author')
         ? $user->with(['books'])->get()
         : App::abort(404);
});


Route::middleware('auth:sanctum')->group(function () {

    // + 3h) Updating author info

    Route::put('/authors/{id}', function(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return $user;
    });

    // + 3d) Updating book by id

    Route::put('/books/{id}', function(Request $request, $id) {
        $book = Book::findOrFail($id);
        $book->update($request->all());

        return $book;
    });

    // + 3e) Deleting book by id

    Route::delete('/books/{id}', function($id) {
        // Book::findOrFail($id)->delete();

        return 204;
    });
});
