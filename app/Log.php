<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Machine;
use App\Event_log;

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


    public static function mubaByDate($dayOutput,$date,$serial,$interval){
        // $dayOutput = $this->getDailyOutputByMachine($date,$serial);
          $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$serial)->
                    whereDate('event_logs.MCGS_Time',$date)->first(); // get the first row of the machine with first occurance of valid error code
        
          $assists = self::assistCodes($serial); // get all valid assist codes for the machine by serial id
          $logs = Event_log::where('serial',$serial)->whereDate('MCGS_Time',$date)->get(); // get all event logs of the machine for the date.
        
          $totalErrors = 0;
          $validAssistArray = array();
   
          $startMark = $firstRow->output;
          $endMark = $firstRow->output + $interval;
          $intervalArray = array();
          $c = 0;
          foreach($logs as $log)
          {
            $c += 1;
            // if( $log->output >= $startMark && $log->output < $endMark)
            // {
            //   if( in_array($log->ERR_event,$assists))
            //   {
            //     //return "$log->ERR_event is in!";
            //     if( in_array($log->ERR_event,$intervalArray)){
            //       $intervalArray[$log->ERR_event] += 1;
            //     } else {
            //        $intervalArray[$log->ERR_event] = 1;
            //     }
                
            //       $validAssistArray[$log->ERR_event] = $intervalArray;
            //   }

            // } else {
            //   $startMark = $endMark;
            //   $endMark += $interval;

            // }

            if(in_array($log->ERR_event,$assists){
              if( $log->output >= $startMark && $log->output < $endMark){
                if( in_array($log->ERR_event,$intervalArray)){
                  $intervalArray[$log->ERR_event] += 1;
                 } else {
                   $intervalArray[$log->ERR_event] = 1;
                 }
              }
            }



          }
          return $c;
          return $validAssistArray;


          // foreach($assists as $a){
          //   if($a->output >= $startMark && $a->output < $endMark){
          //       array_push($errorArray, $a->ERR_event);
          //   } else {
          //       $startMark = $a->output;
          //       $endMark = $startMark + $interval;

          //       array_push($debugArray,$errorArray);
          //       $totalErrors += sizeof(array_unique($errorArray));
          //       $errorArray = array();
          //       array_push($errorArray, $a->ERR_event);


          //   }
          // }


        $result = (object)'';
        if($totalErrors == 0) { // in case total errors is zero
            $totalErrors = 1;}
        $result->muba = round($dayOutput/$totalErrors,2);
        $result->assists =  $totalErrors;
       return $result;

    }

    public static function assistCodes($serial)
    {
      // return DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
      //               select('ERR_event','output')->
      //               where('serial',$serial)->
      //               whereDate('event_logs.MCGS_Time',$date)->get();
      $machine = Machine::where('serial',$serial)->first();
      return $machine->mod->error->pluck('err_code')->toArray(); // make result into array format
    }


}
