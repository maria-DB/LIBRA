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

Route::get('/', function () {
    return view('books');
});
Route::get('books', 'App\Http\Controllers\BooksController@index')->name('books');

//
 Route::get('bookcatalog', 'App\Http\Controllers\CatalogController@index')->name('getCatalog');
 Route::get('aboutus', 'App\Http\Controllers\AboutController@index')->name('getAbout');


   