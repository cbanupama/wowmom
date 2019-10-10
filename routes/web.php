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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login/google', 'API\LoginAPIController@redirectToProvider');
Route::get('login/google/callback', 'API\LoginAPIController@handleProviderCallback');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('languages', 'LanguageController');

Route::resource('superCategories', 'SuperCategoryController');

Route::resource('interests', 'InterestController');

Route::resource('tags', 'TagController');

Route::resource('posts', 'PostController');

Route::resource('foodCategories', 'FoodCategoryController');

Route::resource('images', 'ImageController');

Route::resource('profiles', 'ProfileController');

Route::resource('users', 'UserController');