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

// Route::get('/', function () {
//     return view('books');
// });
Route::get('/', function () {
    return view('/auth/login');;
});


Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
})->name('getLogout');


// inclosed to group middleware with auth
Route::middleware(['auth'])->group(function () {


Route::get('books', 'App\Http\Controllers\BooksController@index')->name('books');

//
 Route::get('bookcatalog', 'App\Http\Controllers\CatalogController@index')->name('getCatalog');
 // Route::get('aboutus', 'App\Http\Controllers\AboutController@index')->name('getAbout');
 Route::get('/userdata', 'App\Http\Controllers\UserCatalogController@index')->name('getUserCatalog');

 Route::get('/recommendation', 'App\Http\Controllers\AboutController@index')->name('getAbout');
 Route::get('/get/book/filter', 'App\Http\Controllers\AboutController@filterRecommend')->name('getFilter');

Route::get('/search/book', 'App\Http\Controllers\BooksController@searchGoogleBook')->name('search.googlebook');

Route::get('/home/popular', 'App\Http\Controllers\HomeController@popularbooks')->name('getHome');

Route::get('/search/book/next', 'App\Http\Controllers\BooksController@searchGoogleBookNext')->name('search.googlebookNext');

Route::get('/book/favorites/true', 'App\Http\Controllers\UserCatalogController@FavoritesTrue')->name('getFavoritesTrue');

Route::get('/book/actlog', 'App\Http\Controllers\UserCatalogController@ActLog')->name('getActLog');

Route::put('/favorite', 'App\Http\Controllers\UserCatalogController@AddtoFavorites')->name('addFav');

Route::get('/get/user/librarybook', 'App\Http\Controllers\UserCatalogController@getUserBooks')->name('userbooks');

Route::get('/search/book/back', 'App\Http\Controllers\BooksController@searchGoogleBookBack')->name('search.googlebookBack');
Route::get('/add/book/collection/', 'App\Http\Controllers\BooksController@addToBook')->name('add.googlebook');
Route::get('/book/popular', 'App\Http\Controllers\BooksController@getPopular')->name('book.popular');

});
Route::post('/userdata', 'App\Http\Controllers\UserCatalogController@avatar')->name('useravatar');
Route::get('/reviews', 'App\Http\Controllers\ReviewController@index')->name('review.index');
Route::get('/reviews/get/', 'App\Http\Controllers\ReviewController@getBookReview')->name('book.review');
Route::get('/reviews/get/recommended/', 'App\Http\Controllers\ReviewController@getRecommendation')->name('book.reco');
Route::post('/add/book/comment', 'App\Http\Controllers\ReviewController@addComment')->name('user.comment');
Route::post('/add/book/rating', 'App\Http\Controllers\ReviewController@addRating')->name('user.rating');