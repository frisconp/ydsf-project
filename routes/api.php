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
    Route::get('/{slug}', 'API\ProgramController@getBySlug');
    Route::get('/status/completed', 'API\ProgramController@getCompletedProgram');
});
Route::resource('program', 'API\ProgramController');

Route::group(['prefix' => 'post'], function () {
    Route::get('/{slug}', 'API\PostController@getBySlug');
});
Route::resource('post', 'API\PostController');

Route::resource('branch-office', 'API\BranchOfficeController');
Route::resource('ebook', 'API\EbookController');

Route::get('/donation-account/{branch_office_id}', 'API\DonationAccountController@getByBranchOfficeId');

Route::group(['prefix' => 'password', 'namespace' => 'API'], function () {
    Route::post('/create', 'PasswordResetController@create');
    Route::get('/find/{token}', 'PasswordResetController@find');
    Route::post('/reset','PasswordResetController@reset');
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::group(['prefix' => 'donation'], function () {
        Route::post('/add', 'API\DonationController@addDonation');
    });

    Route::post('/change-password', 'API\AuthController@changePassword');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/profile', 'API\UserController@getProfile');
    });
});
