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

Route::get('/login', 'LoginController@index')->name('login');
Route::get('/logout', 'LoginController@logout')->name('logout');
Route::post('/login-auth', 'LoginController@authenticate');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        $title = 'Halaman Utama';
        return view('pages.dashboard', compact('title'));
    })->name('dashboard');

    Route::resource('branch-office', 'BranchOfficeController');
    Route::resource('admin', 'AdminController');
});
