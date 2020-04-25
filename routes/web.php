<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'Admin/UsersController');

Route::resource('posts',  'Admin/PostController');
Route::get('table/posts', 'Admin/PostController@table')->name('posts.table');

Route::resource('comments',  'Admin/CommentController');
Route::get('table/comments', 'Admin/CommentController@table')->name('comments.table');
