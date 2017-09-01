<?php

namespace App\Http\Controllers;

use App\Machines;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class uploadController extends Controller
{
    public function index(){

    	return Machines::all();
//    	return request()->input('task');
  //  	return DB::table('machines')->get();
    }
}
