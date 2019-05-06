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
//Login
Route::get('/system','Admin\LoginController@index')->name('login.system');
Route::post('/system/login','Admin\LoginController@auth')->name('login.login');

//Homepage
Route::get('/','IndexController@index');

//Product
Route::get('/product/{key}','ProductController@index');

Route::post('/product/auction','ProductController@auction')->name('products.auction');

//Category
Route::get('/category/{slug}','CategoryController@index');

//Search
Route::post('/search','SearchController@search')->name('search.search');
Route::get('/search/{search}','SearchController@index');


//Backend
Route::group(['prefix'=>'system','middleware' => 'check.admin'],function (){
//Route::group(['prefix'=>'system'],function (){
    //Logout
    Route::get('/logout','Admin\LoginController@logout');
//User
    Route::get('/users', 'Admin\UserController@index');
    Route::post('/users/create', 'Admin\UserController@store')->name('users.create');
    Route::post('/users/update', 'Admin\UserController@update')->name('users.update');
    Route::post('/users/delete', 'Admin\UserController@delete');


//Category
    Route::get('/categories', 'Admin\CategoryController@index');
    Route::post('/categories/create', 'Admin\CategoryController@store')->name('categories.create');
    Route::post('/categories/update', 'Admin\CategoryController@update')->name('categories.update');
    Route::post('/categories/delete', 'Admin\CategoryController@delete');
    Route::get('/categories/order/{id}/{order}/{mode}','Admin\CategoryController@order');


//Slide show
    Route::get('/slide_show', 'Admin\SlideShowController@index');
    Route::post('/slide_show/create', 'Admin\SlideShowController@store')->name('slide_show.create');
    Route::post('/slide_show/update', 'Admin\SlideShowController@update')->name('slide_show.update');
    Route::post('/slide_show/delete', 'Admin\SlideShowController@delete');
    Route::get('/slide_show/order/{id}/{order}/{mode}','Admin\SlideShowController@order');


//Product
    Route::get('/products', 'Admin\ProductController@index');
    Route::post('/products/create', 'Admin\ProductController@store')->name('products.create');
    Route::get('/products/update/{id}','Admin\ProductController@show_update');
    Route::post('/products/update', 'Admin\ProductController@update')->name('products.update');
    Route::post('/products/delete', 'Admin\ProductController@delete');

    Route::post('/products/picture','Admin\ProductController@product_picture')->name('products.picture');
    Route::post('/products/picture/delete','Admin\ProductController@delete_picture')->name('products.picture.delete');

//Contact
    Route::get('/contacts','Admin\ContactController@index');
    Route::post('/contacts/delete','Admin\ContactController@delete');

//History
    Route::get('/products/history/{id}','Admin\ProductController@history');
});
