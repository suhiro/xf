<?php
use App\Machines;

Route::get('/',function(){
	return redirect(route('login'));
});

Route::get('/log','LogController@log');

Route::post('/log','LogController@log');




//uploading csv file
Route::get('/upload/csv','uploadController@index');
Route::get('/upload/{id}',function($id){
	return Machines::find($id);
});
Route::post('/upload','uploadController@doUpload');


// Jam Summary
Route::get('/jams','JamController@index');
Route::post('/jams/summary','JamController@summary');


// Analitics
Route::get('/day','LogController@log');




//Factory
Route::get('/factory','FactoryController@index');
Route::get('/factory/create','FactoryController@create');
Route::post('/factory/store','FactoryController@store');
Route::get('/factory/{id}','FactoryController@show');
Route::get('/factory/{id}/show','FactoryController@edit');
Route::post('/factory/{id}/update','FactoryController@update');
Route::post('/factory/{id}','FactoryController@show');
Route::get('/factory/{id}/remove','FactoryController@destroy');
// Model
Route::get('/model','ModelController@index');
Route::get('/model/{model}/show','ModelController@show');
Route::get('/model/create','ModelController@create');
Route::post('/model/store','ModelController@store');
Route::get('/model/{id}/edit','ModelController@edit');
Route::post('/model/{id}/update','ModelController@update');
Route::post('/model/{model}/remove','ModelController@destroy');
// Error
Route::get('/model/{id}/error/create','ErrorController@create');
Route::get('/model/error/{error}/edit','ErrorController@edit');
Route::post('/model/error/{id}/update','ErrorController@update');
Route::post('/model/error/{id}/store','ErrorController@store');
Route::post('/model/error/destroy','ErrorController@destroy');

// Component
Route::get('/model/{id}/component/create','ComponentController@create');
Route::post('/model/component/store','ComponentController@store');
// Machine
Route::get('/machine','MachineController@index');
Route::get('/machine/create','MachineController@create');
Route::post('/machine/store','MachineController@store');
Route::get('/machine/{id}/edit','MachineController@edit');
Route::post('/machine/{id}/update','MachineController@update');
Route::post('/machine/{machine}/remove','MachineController@destroy');
//Auth
Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/logout','Auth\LoginController@logout');

//Packages
Route::get('/package','PackageController@index');
Route::get('/package/create','PackageController@create');
Route::post('/package/store','PackageController@store');
Route::get('/package/{id}/edit','PackageController@edit');
Route::post('/package/{id}/update','PackageController@update');
Route::get('/package/{id}/remove','PackageController@destroy');