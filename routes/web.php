<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('books');
});

Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
})->name('getLogout');


Route::get('books', 'App\Http\Controllers\BooksController@index')->name('books');

//
 Route::get('bookcatalog', 'App\Http\Controllers\CatalogController@index')->name('getCatalog');
 Route::get('aboutus', 'App\Http\Controllers\AboutController@index')->name('getAbout');

Route::get('/search/book', 'App\Http\Controllers\BooksController@searchGoogleBook')->name('search.googlebook');
Route::get('/search/book/next', 'App\Http\Controllers\BooksController@searchGoogleBookNext')->name('search.googlebookNext');
Route::get('/search/book/back', 'App\Http\Controllers\BooksController@searchGoogleBookBack')->name('search.googlebookBack');
Route::get('/add/book/collection/', 'App\Http\Controllers\BooksController@addToBook')->name('add.googlebook');
Route::get('/book/popular', 'App\Http\Controllers\BooksController@getPopular')->name('book.popular');