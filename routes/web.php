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
Route::get('/factory/create','FactoryController@create');
Route::post('/factory/store','FactoryController@store');
Route::get('/factory/{id}','FactoryController@show');

// Machine
Route::get('/machine','MachineController@index');
Route::get('/machine/create','MachineController@create');
Route::post('/machine/store','MachineController@store');
//Auth
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');
