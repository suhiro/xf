<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Log extends Model
{
    public static function getMUBA($serial,$interval,$from,$to){

        
          $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time','>=',$from)->first();
       	return 999;
         $assists = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    select('ERR_event','output')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time','>=',$from)->whereDate('event_logs.MCGS_Time','<=',$to)->get();

   			$totalErrors = 0;
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


        
        if($totalErrors == 0) { // in case total errors is zero
            $totalErrors = 1;}
        $muba = round($dayOutput/$totalErrors,2);
        
       return $muba;

    }


    public static function getMUBA3($dayOutput,$date,$serial,$interval){
        // $dayOutput = $this->getDailyOutputByMachine($date,$serial);
          $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->first();
        
          $assists = self::assistCodes($serial,$date);
        
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
        if($totalErrors == 0) { // in case total errors is zero
            $totalErrors = 1;}
        $result->muba = round($dayOutput/$totalErrors,2);
        $result->assists =  $totalErrors;
       return $result;

    }

    public static function assistCodes($serial,$date)
    {
      return DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    select('ERR_event','output')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->get();
    }


}
