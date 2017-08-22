<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(){

    	
    	return view('logs.index');
    }
    public function log(){


    	$logs = DB::table('work_log')->whereDate('timeStart','2017-07-07')->get();

    	$currentSerial = '';
    
    	foreach($logs as $log){
    		if($currentSerial == $log->serial){

    				$obj = new stdClass();

    				$obj->serial = $currentSerial;
    				$obj->logs = array();
    				
    			
    		} else {
    			$currentSerial = $log->serial;
    		}
    	}


    	return view('logs.log',compact('logs'));
    }
}
