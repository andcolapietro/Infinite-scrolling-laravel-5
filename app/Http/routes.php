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

Route::get('', 'Upload_picturesController@index');
Route::get('home', 'Upload_picturesController@index');
Route::get('gallery', 'Upload_picturesController@gallery');
Route::get('gallery-item/{id}', 'Upload_picturesController@gallery');
Route::post('upload', array('as' => 'upload', 'uses' => 'Upload_picturesController@store'));
Route::post( 'scrolling', array('as' => 'scrolling', 'uses' => 'Upload_picturesController@scrolling' ));


