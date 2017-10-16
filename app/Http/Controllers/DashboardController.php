<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Factory;
use App\Machine;
use App\Work_log;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){

    	$dt = Carbon::now();

    	$factories = Factory::where('user_id',Auth::id())->get();

    	$machines = Machine::where('user_id',Auth::id())->get();


    	$output = array(
    		'SOIC' => 0,
    		'RESOP' => 0,
    		'EDIP' => 0,
    	);
    	
    	foreach($machines as $m){
    		switch($m->mod->package){
    		case 'SOIC':
    				$output['SOIC'] += Work_log::monthToDateOutput($dt->year,$dt->month,$m->serial);
    				

    				break;
    		case 'RESOP':
    				$output['RESOP'] += Work_log::monthToDateOutput($dt->year,$dt->month,$m->serial);
    			

    				break;
    			}
    	}



    	return view('dashboard.index',compact('factories','output'));
    }
}
