<?php

// Route::get('/', function () {

// 	$events = DB::table('lot_events')->get();
//    // return view('welcome',compact('events'));
// 	return view('master.layout');
// });

<<<<<<< HEAD
	$events = DB::table('lot_events')->get();
    return view('welcome',compact('events'));
	//return "hello";
});
=======
Route::get('/','LogController@index');
>>>>>>> 9461084b77fc4da61fa69c66f9287dcdd16e57a0
