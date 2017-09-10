<?php
use App\Machines;

Route::get('/','LogController@log');

Route::get('log','LogController@log');

Route::post('log','LogController@log');




//uploading csv file
Route::get('/upload','uploadController@index');
Route::get('/upload/{id}',function($id){
	return Machines::find($id);
});
Route::post('/upload','uploadController@doUpload');


//Auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
