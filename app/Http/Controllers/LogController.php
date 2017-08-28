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
            $interval = request()->input('interval');
    		$logs = DB::table('work_log')->whereDate('timeStart',$viewDate)->get();
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
                $obj->output = $this->getDailyOutputByMachine($viewDate,$log->serial);
                $obj->model = $this->getModel($log->serial);
                $obj->errors = $this->getTotalErrors($viewDate,$log->serial);
                $obj->muba = $this->getMUBA($viewDate,$log->serial,$interval);
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
    private function getModel($serial){
        return DB::table('machines')->where('serial',$serial)->value('model');
    }
    
    private function getAllErrors($model){
        return DB::table('erros')->where('model',$model)->get();
    }

    private function getTotalErrors($date,$serial){

        $model = $this->getModel($serial);
        $model_errors = $this->getAllErrors($model);

        $allEvents = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)->get();
        $totalErrors = 0;
        foreach($allEvents as $e){
                  
                       foreach($model_errors as $error){
                            if($error->err_code == $e->ERR_event){
                                 $totalErrors += 1;
                            }
                        }
                    }
        return $totalErrors;
    }

    private function getMUBA($date,$serial,$interval){
        
        $model = $this->getModel($serial);
        $model_errors = $this->getAllErrors($model);
        $dayOutput = $this->getDailyOutputByMachine($date,$serial);

        $loops = ceil($dayOutput / $interval);

        $firstRow = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)->first();

        $totalErrors = 0;
        $startMark = $firstRow->output;
        $endMark = $firstRow->output;


       // $debugArray=array(); // method  1

        for ($i = 0; $i < $loops; $i++){
            $endMark += $interval;  
            $partials = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)
                  ->where('output','<=',$endMark)->where('output','>=',$startMark)->get();

		//  $errorArray = array(); // method  1
          $assistArray = array(); // method  2
           foreach($partials as $p){

            foreach($model_errors as $e){
                if($e->err_code == $p->ERR_event){

                   // $errorArray[$e->err_code] = true; // method  1

                    array_push($assistArray,$p->ERR_event); // method  2

                }
            }    


           }
           //  array_push($debugArray,$errorArray); // method 1

            $assistArray = array_unique($assistArray); // method  2
            $totalErrors += sizeof($assistArray); // method  2

            $startMark += $interval; 

        } 
               

        //$sizeOfTrue = $this->getSize($debugArray); // method 1
        //dd($totalErrors);
        //dd($sizeOfTrue);

       return round($dayOutput/$totalErrors,2); // method 2
      // return round($dayOutput/$sizeOfTrue,2); //method 1
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
        $output = DB::table('lot_events')
                    ->select(DB::raw('max(output)-min(output) as output'))
                        ->where('serial',$serial)
                        ->whereDate('created_at',$date)
                        ->value('output');
        return $output;
    }

}
