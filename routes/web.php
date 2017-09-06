<?php
use App\Machines;

Route::get('/','logController@index');

Route::get('log','logController@log');

Route::post('log','logController@log');
Route::get('/upload','uploadController@index');

Route::get('/upload/{id}',function($id){
	return Machines::find($id);
});

Route::post('/doUpload','uploadController@doUpload');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
