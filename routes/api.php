<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', 'API\RegisterController@register');
Route::post('/login', 'API\LoginController@validateLogin');

Route::group(['prefix' => 'program'], function () {
    Route::get('/all', 'API\ProgramController@getAll');
    Route::get('/{program}', 'API\ProgramController@getById');
});

Route::group(['prefix' => 'branch-office'], function () {
    Route::get('/all', 'API\BranchOfficeController@all');
    Route::get('/{branchOffice}', 'API\BranchOfficeController@getById');
});

Route::resource('post', 'API\PostController');
Route::resource('ebook', 'API\EbookController');

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'donation'], function () {
        Route::post('/add', 'API\DonationController@addDonation');
    });
});
