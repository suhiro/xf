<?php


namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Work_log;
use App\Machine;

class LogController extends Controller
{
    public function index(){
    	return view('logs.index');
    }
    public function log(){

        // $this->validate(request(),[
        //     'view_date' => 'required',
        //     ]);

    		$viewDate = request('view_date');
            $interval = request('interval');
    		$logs = Work_log::whereDate('timeStart',$viewDate)->get();
    

    	$currentSerial = '';
        $machineArray = array();
    
    	foreach($logs as $log){
    		$obj = (object)"";
            if($currentSerial != $log->serial){
                 $currentSerial = $log->serial;

                $obj->serial = $log->serial;
                $obj->output = $this->getDailyOutputByMachine($viewDate,$log->serial);
              
                $obj->model = Machine::where('serial',$log->serial)->first()->mod->name;
                $obj->errors = $this->getTotalErrors($viewDate,$log->serial);
                $muba = $this->getMUBA3($viewDate,$log->serial,$interval);
                $obj->muba = $muba->muba;
                $obj->assists = $muba->assists; 
                $obj->interval = $interval;

            // get all the work logs for the current machine
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
   
    
    private function getAllErrors($model){
        return DB::table('erros')->where('model',$model)->get();
    }

    private function getTotalErrors($date,$serial){
        return DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->whereDate('event_logs.MCGS_Time',$date)->count();
    }
    private function getMUBA2($date,$serial,$interval){
         $dayOutput = $this->getDailyOutputByMachine($date,$serial);
         $loops = ceil($dayOutput / $interval);
         $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->whereDate('event_logs.MCGS_Time',$date)->first();

        $totalErrors = 0;
        $startMark = $firstRow->output;
        $endMark = $firstRow->output;

         for ($i = 0; $i < $loops; $i++){
            $endMark += $interval;  
            $partials = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->
                    where('output','<=',$endMark)->
                    where('output','>=',$startMark)->get();
            

            $assistArray = array(); 
            foreach($partials as $p){    
                 array_push($assistArray,$p->ERR_event); 
            }
            $assistArray = array_unique($assistArray); 
            $totalErrors += sizeof($assistArray); 

            $startMark += $interval;     

        }
          $result = (object)"";
        $result->muba = round($dayOutput/$totalErrors,2);
        $result->assists =  $totalErrors;
       return $result;

    }
    private function getMUBA3($date,$serial,$interval){
         $dayOutput = $this->getDailyOutputByMachine($date,$serial);
          $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->first();
        
         $assists = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    select('ERR_event','output')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->get();
          $totalErrors = 0;
          $debugArray = array();
   
          $startMark = $firstRow->output;
          $endMark = $firstRow->output + $interval;
          $errorArray = array();
          foreach($assists as $a){
            if($a->output >= $startMark && $a->output < $endMark){
                array_push($errorArray, $a->ERR_event);
            } else {
                $startMark = $a->output;
                $endMark = $startMark + $interval;

                array_push($debugArray,$errorArray);
                $totalErrors += sizeof(array_unique($errorArray));
                $errorArray = array();
                array_push($errorArray, $a->ERR_event);


            }
          }


        $result = (object)'';
        $result->muba = round($dayOutput/$totalErrors,2);
        $result->assists =  $totalErrors;
       return $result;

    }

    private function withinInterval($output1,$output2,$interval){
        if (($output2 - $output1) <= $interval) {

        } else {
            return false;
        }
    }


    private function getSize($Arr){
         $sizeOfTrue =0;
        foreach($Arr as $d){
            foreach($d as $k => $v){
                if($v){
                    $sizeOfTrue +=1;
                }
            }
        }
        return $sizeOfTrue;
    }


    private function getDailyOutputByMachine($date,$serial){
        $output = DB::table('event_logs')
                    ->select(DB::raw('max(output)-min(output) as output'))
                        ->where('serial',$serial)
                        ->whereDate('MCGS_Time',$date)
                        ->value('output');
        return $output;
    }

}