<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Factory;

class DashboardController extends Controller
{
    public function index(){
    	$factories = Factory::where('user_id',Auth::id())->get();
    	
    	return view('dashboard.index',compact('factories'));
    }
}
