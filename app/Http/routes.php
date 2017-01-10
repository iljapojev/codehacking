<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    
    Route::auth();

    Route::get('/home', 'HomeController@index');
    
    Route::get('/post/{id}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

});

Route::group(['middleware' => ['web', 'admin']], function() {

    Route::get('/admin', function(){
        return view('admin.index');
    });

    Route::resource('/admin/users', 'AdminUsersController');
    
    Route::resource('/admin/posts', 'AdminPostsController');
    
    Route::resource('/admin/categories', 'AdminCategoriesController');
    
    Route::resource('/admin/media', 'AdminMediaController');
    
    Route::resource('/admin/comments', 'PostCommentsController');
    
    Route::resource('/admin/comment/replies', 'CommentRepliesController');

});
