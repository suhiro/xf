<?php

// Route::get('/', function () {

// 	$events = DB::table('lot_events')->get();
//    // return view('welcome',compact('events'));
// 	return view('master.layout');
// });

Route::get('/','LogController@index');