<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>''],function(){
    Route::get('user/folders/{userID}','UserController@getUserFolders');
    Route::resource('user', 'UserController');
});

Route::group(['prefix'=>''],function(){
    Route::resource('folder', 'FolderController');
});

Route::group(['prefix'=>''],function(){
    Route::resource('file', 'FileController');
});


Route::auth();

Route::get('/home', 'HomeController@index');
