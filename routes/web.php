<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('role:admin')->group(function() {
    Route::resource('users',  UserController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('books',  BookController::class);
});

Route::get('author/users',  'AuthorController@users'  )->name('author.users');
Route::get('author/genres', 'AuthorController@genres' )->name('author.genres');
Route::get('author/books',  'AuthorController@books'  )->name('author.books');
