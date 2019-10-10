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
//Route::post('login', 'UserAPIController@login');
Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::post('g-login', 'LoginAPIController@loginWithAPI');
Route::post('onboard-user', 'UserAPIController@onBoard');
Route::post('onboard-Android', 'UserAPIController@onBoardAndroid');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('superCategory-by-interest', 'InterestAPIController@getInterestBySuperCategory');

Route::resource('languages', 'LanguageAPIController');

Route::resource('super_categories', 'SuperCategoryAPIController');

Route::resource('interests', 'InterestAPIController');

Route::resource('tags', 'TagAPIController');

Route::resource('posts', 'PostAPIController');

Route::get('posts/filter-by-super-category/{id}', 'PostAPIController@filterBySuperCategory');

Route::resource('images', 'ImageAPIController');

Route::resource('profiles', 'ProfileAPIController');