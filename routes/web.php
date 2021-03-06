<?php

use App\Http\Controllers\LibrariesController;
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
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/libraries/create', 'LibrariesController@create')->name('create.libraries');
Route::post('/books/create', 'BookController@create')->name('create.book');
Route::delete('/delete/{id}','LibrariesController@destroy')->name('delete.libraries');
Route::delete('/deletebook/{id}','BookController@destroy')->name('delete.book');
