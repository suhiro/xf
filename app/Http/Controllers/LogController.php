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
                $obj->muba = $this->getMUBA($viewDate,$log->serial);
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

    private function getMUBA($date,$serial){
        $interval = 100;
        $model = $this->getModel($serial);
        $model_errors = $this->getAllErrors($model);
        $dayOutput = $this->getDailyOutputByMachine($date,$serial);

        $loops = ceil($dayOutput / $interval);

        $firstRow = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)->first();

        $totalErrors = 0;
        $startMark = $firstRow->output;
        $endMark = $firstRow->output;

        //$partials;

        $debugArray=array();

        for ($i = 0; $i < $loops; $i++){
            $endMark += $interval;  
            $partials = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)
                  ->where('output','<=',$endMark)->where('output','>=',$startMark)->get();

          	

          	//$loopArray = array();
			$errorArray = array();
           foreach($partials as $p){

            foreach($model_errors as $e){
                if($e->err_code == $p->ERR_event){

                   $errorArray[$e->err_code] = true;

                  // array_push($debugArray,$errorArray);


                	//array_push($errorArray,$p->ERR_event);
                    //$totalErrors += 1;
                }
            }
                 $totalErrors += sizeof($errorArray);

                 // array_push($loopArray,$errorArray);
                 	


           }
           array_push($debugArray,$errorArray);
          // 	array_push($debugArray,$loopArray);

           $startMark += $interval; 

        } 
               

        //foreach($allEvents as $e){
        // for($i = 0; $i < sizeof($allEvents);$i++){
            
        //        //$firstOut = $allEvents[$i]->output;
        //        $endMark = $firstOutput + $interval;   
        //                foreach($model_errors as $error){
        //                     if($error->err_code == $allEvents[$i]->ERR_event){
        //                          $totalErrors += 1;
        //                     }
        //                 }
        //             }

        //return $dayOutput;
        //return $totalErrors;
       	//dd(sizeof($debugArray));
        $sizeOfTrue =0;
        foreach($debugArray as $d){
        	foreach($d as $k => $v){
        		if($v){
        			$sizeOfTrue +=1;
        		}
        	}
        }

        //dd($sizeOfTrue);
        
        return round($dayOutput/$sizeOfTrue,2);
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
