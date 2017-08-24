<?php

Route::get('/','logController@index');

Route::get('log','logController@log');

Route::post('log','logController@log');