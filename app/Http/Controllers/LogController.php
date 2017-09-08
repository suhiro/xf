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

        $bike = new Motorcycle('Honda','CBR','1000','Red');

    	if(!empty(request())){
    		$viewDate = request()->input('view_date');
            $interval = request()->input('interval');
    		$logs = DB::table('work_logs')->whereDate('timeStart',$viewDate)->get();
    	}
    	else {
    	$logs = DB::table('work_logs')->whereDate('timeStart','2017-7-12')->get();
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

    	return view('logs.log',compact('logs','machineArray','bike'));
    }
    private function getModel($serial){
        return DB::table('machines')->where('serial',$serial)->value('model');
    }
    
    private function getAllErrors($model){
        return DB::table('erros')->where('model',$model)->get();
    }

    private function getTotalErrors($date,$serial){
        return DB::table('lot_events')->join('errors','lot_events.ERR_event','errors.err_code')->
                    where('serial',$serial)->whereDate('lot_events.created_at',$date)->count();
    }
    private function getMUBA2($date,$serial,$interval){
         $dayOutput = $this->getDailyOutputByMachine($date,$serial);
         $loops = ceil($dayOutput / $interval);
         $firstRow = DB::table('lot_events')->join('errors','lot_events.ERR_event','errors.err_code')->
                    where('serial',$serial)->whereDate('lot_events.created_at',$date)->first();

        $totalErrors = 0;
        $startMark = $firstRow->output;
        $endMark = $firstRow->output;

         for ($i = 0; $i < $loops; $i++){
            $endMark += $interval;  
            $partials = DB::table('lot_events')->join('errors','lot_events.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('lot_events.created_at',$date)->
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
          $firstRow = DB::table('lot_events')->join('errors','lot_events.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('lot_events.created_at',$date)->first();
        
         $assists = DB::table('lot_events')->join('errors','lot_events.ERR_event','errors.err_code')->
                    select('ERR_event','output')->
                    where('serial',$serial)->
                    whereDate('lot_events.created_at',$date)->get();
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

    private function getMUBA($date,$serial,$interval){
        
        $model = $this->getModel($serial);
        $model_errors = $this->getAllErrors($model);
        $dayOutput = $this->getDailyOutputByMachine($date,$serial);

        $loops = ceil($dayOutput / $interval);

        $firstRow = DB::table('lot_events')->where('serial',$serial)->whereDate('created_at',$date)->first();

        $totalErrors = 0; // method 2
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


class Motorcycle {
    protected $brand;
    protected $cc;
    public $color;
    protected $model;
    public function __construct($brand,$model,$cc,$color){
        $this->brand = $brand;
        $this->model =$model;
        $this->cc = $cc;
        $this->color = $color; 
    }

    public function brand(){
        return $this->brand;
    }

}
