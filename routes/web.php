<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/password', 'UsersController@change')->name('users.password');
    Route::post('change_password','UsersController@changePassword')->name('users.changePassword');

    Route::resource('users', 'UsersController');

    Route::resource('posts',  'PostController');
    Route::get('table/posts', 'PostController@table')->name('posts.table');

    Route::resource('comments',  'CommentController');
    Route::get('table/comments', 'CommentController@table')->name('comments.table');



});
