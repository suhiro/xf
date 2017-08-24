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

    	if(!empty(request())){
    		$viewDate = request()->input('view_date');
    		$logs = DB::table('work_log')->whereDate('timeStart',$viewDate)->get();
    		//dd($viewDate);
    	}
    	
    	else {

    	$logs = DB::table('work_log')->whereDate('timeStart','2017-7-12')->get();

    	}

    	$currentSerial = '';
        $machineArray = array();
    
    	foreach($logs as $log){
    		$obj = (object)"";
            if($currentSerial != $log->serial){
                 $currentSerial = $log->serial;

           
            $obj->serial = $log->serial;
            $obj->logs = array();

            foreach($logs as $innerLog){
                if($currentSerial == $innerLog->serial){
                     $logObj = (object)"";
                     $logObj->startTime = $innerLog->timeStart;
                     $logObj->endTime = $innerLog->timeEnd;
                     array_push($obj->logs,$logObj);
                }
            }
            array_push($machineArray,$obj);
            } 
    	}

        


    	return view('logs.log',compact('logs','machineArray'));
    }
}
