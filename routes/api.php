<?php

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

/* --------------------------------
 * 		Users Routes
 --------------------------------- */
Route::post('/register', 'Auth\RegisterController@register');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
Route::middleware('auth:api')->put('/me', 'UserController@me');

/* --------------------------------
 * 		Advertisements Routes
 --------------------------------- */
Route::middleware('auth:api')->resource('/advertisements', 'AdvertisementController');
Route::middleware('auth:api')->patch('/advertisements/{uuid}/toggle-published', 'AdvertisementController@togglePublished');
Route::middleware('auth:api')->post('/advertisements/{uuid}/pictures', 'PictureController@store');
Route::middleware('auth:api')->delete('/advertisements/{uuid}/pictures/{picture}', 'PictureController@destroy');
Route::middleware('auth:api')->get('/advertisements/{uuid}/pictures', 'AdvertisementController@pictures');

// Public Routes
Route::get('/advertisement/{uuid}', 'AdvertisementController@showAdvertisement');
Route::get('/advertisement/{uuid}/images', 'AdvertisementController@showAdvertisementPictues');
Route::get('/search', 'AdvertisementController@searchAdvertisement');

/* --------------------------------
 * 		Pictures Routes
 --------------------------------- */
Route::middleware('auth:api')->resource('/pictures', 'AdvertisementController');
Route::get('/images/{image}', 'ImageController@show');
Route::get('/images/{width}/{image}', 'ImageController@resize');
Route::get('/images/{width}/{height}/{image}', 'ImageController@fit');