<?php
use App\Machines;

Route::get('/','DashboardController@index');

Route::get('/log','LogController@log');

Route::post('/log','LogController@log');




//uploading csv file
Route::get('/upload','uploadController@index');
Route::get('/upload/{id}',function($id){
	return Machines::find($id);
});
Route::post('/upload','uploadController@doUpload');


//Factory
Route::get('/factory/create','FactoryController@create');
Route::post('/factory/store','FactoryController@store');

// Machine
Route::get('/machine','MachineController@index');
Route::get('/machine/create','MachineController@create');
Route::post('/machine/store','MachineController@store');
//Auth
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
