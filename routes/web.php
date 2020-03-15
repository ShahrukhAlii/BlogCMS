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



Auth::routes();
//add prefix to all these routes
//or you can add in group middleware
//
Route::group(['prefix'=>'admin/','middleware'=>'auth'],function(){

Route::get('posts/trashed','PostController@trashed')->name('posts.trashed');
Route::get('posts/restore/{id}','PostController@restore')->name('posts.restore');
Route::get('posts/kill/{id}','PostController@kill')->name('posts.kill');
Route::resource('posts','PostController');
Route::resource('categories','CategoryController');
// tag route
Route::resource('tags','TagController');
Route::get('/home', 'HomeController@index')->name('home');

//User route
// We need id for user
Route::get('make/admin/{id}','UserController@make_admin')->name('make.admin');
Route::get('remove/admin/{id}','UserController@remove_admin')->name('remove.admin');
// Need id but we are using current user id using Auth
Route::get('myprofile','UserController@my_profile')->name('users.profile');
Route::resource('users','UserController');
// For settings route
Route::get('settings','SettingController@settings')->name('settings');
Route::put('settings/update/{id}','SettingController@update')->name('settings.update');
});
// If you want to add this to prefix as as well you need to change redirect
// path after login/register in their controller
//You can either append in single route
//
// Route::get('test','controller@func')->middleware('auth');



//This is for category section
Route::get('/category/{id}','PagesController@category')->name('category.single');

Route::get('/tag/{id}','PagesController@tag')->name('tag.single');
// We will use post slug to make url
Route::get('/{slug}','PagesController@single')->name('page.single');
// Lets make controller to handle pages
Route::get('/', 'PagesController@index')->name('page.index');
