<?php
use App\Machines;

Route::get('/',function(){
	return redirect(route('login'));
});

Route::get('/log','LogController@log');

Route::post('/log','LogController@log');




//uploading csv file
Route::get('/upload','uploadController@index');
Route::get('/upload/{id}',function($id){
	return Machines::find($id);
});
Route::post('/upload','uploadController@doUpload');


// Analitics
Route::get('/day','LogController@log');




//Factory
Route::get('/factory','FactoryController@index');
Route::get('/factory/create','FactoryController@create');
Route::post('/factory/store','FactoryController@store');
Route::get('/factory/{id}','FactoryController@show');
Route::get('/factory/{id}/show','FactoryController@edit');
Route::post('/factory/{id}/update','FactoryController@update');
// Machine
Route::get('/machine','MachineController@index');
Route::get('/machine/create','MachineController@create');
Route::post('/machine/store','MachineController@store');
Route::get('/machine/{id}/edit','MachineController@edit');
Route::post('/machine/{id}/update','MachineController@update');
//Auth
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
