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

Auth::routes();


// Главная страница
Route::group(['namespace' => 'Blog'], function () {
    Route::get('/', 'PostController@index')->name('posts');
    Route::get('posts/{id}', 'PostController@show')->where('id', '[0-9]+')->name('show');
});
//Главная страница админки
Route::get('/home', 'HomeController@index')->name('home');

// Админка блога.
Route::group(['middleware' => ['auth'],'namespace' => 'Blog\Admin', 'prefix' => 'blog/admin'], function () {
    // CRUD постов блога.
    Route::resource('posts', 'PostAdminController')->names('blog.admin.posts');
    // CRUD категорий блога.
    Route::resource('category', 'CategoryAdminController')->names('blog.admin.category');
});

