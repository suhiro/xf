<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Machine;
use App\Event_log;

class Log extends Model
{

    public static function muba($serial,$interval,$from,$to)
    {
      
      $event_logs = Event_log::where('serial',$serial)->whereBetween('MCGS_Time',[$from,$to])->get(); // All logs for the given machine for the given period
      $validAssists = self::assistCodes($serial); // all valid for the machine model, identified by machine serial id
      $filteredLogs = $event_logs->whereIn('ERR_event',$validAssists); // all logs with only valid assist errors
      $result = collect(); // collcection holding all result data
      $intervals = collect(); // collection form holding all output intevals
      

      $totalValidAssists = 0; // the toltal assists number for calculating desired MUBA;
      $minOutput = $filteredLogs->min('output');
      $maxOutput = $filteredLogs->max('output');
      $result->put('min',$minOutput);
      $result->put('max',$maxOutput);


      $startMark = $filteredLogs->first()->output; // first log output with valid assist output 
      $endMark = $startMark + $interval;
      $result->put('firstOutput',$startMark);
      $result->put('secondOutput',$endMark);

      while( $startMark < $maxOutput){
        $currentInterval = $filteredLogs->where('output','>=',$startMark)->where('output','<',$endMark);
        if( $currentInterval->isNotEmpty()){

          $intervalAssists = collect();

          foreach($currentInterval as $currentLog){  // find if error code in current events interval
            if(!$intervalAssists->has($currentLog->ERR_event)){
                  $intervalAssists->put($currentLog->ERR_event , 1);
            } else {
                  $intervalAssists[$currentLog->ERR_event] +=1 ;
            } 
          }

          $totalValidAssists += count($intervalAssists);

           $intervals->put('interval'.$startMark, $intervalAssists);
        }
        $endMark  += $interval;
        $startMark += $interval;

      }

      $result->put('intervals',$intervals);
      


      $allAssists = collect();
      foreach($filteredLogs as $log)
      {
        if(!$allAssists->has($log->ERR_event)){
          $allAssists->put($log->ERR_event , 1);
        } else {
          $allAssists[$log->ERR_event] +=1 ;
        } 

      }
      $result->put('allAssists',$allAssists);

      // total out put for the giving period
      $totalOutput = self::totalOutput($serial,$from,$to);
      $result->put('totalOutput',$totalOutput);
      $result->put('totalValidAssists',$totalValidAssists);
      $muba = $totalOutput / $totalValidAssists;  // get the final MUBA!
      $result->put('muba',$muba);
      return $result;
    }

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


    // public static function mubaByDate($dayOutput,$date,$serial,$interval){
    //     // $dayOutput = $this->getDailyOutputByMachine($date,$serial);
    //       $firstRow = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
    //                 where('serial',$serial)->
    //                 whereDate('event_logs.MCGS_Time',$date)->first(); // get the first row of the machine with first occurance of valid error code
        
    //       $assists = self::assistCodes($serial); // get all valid assist codes for the machine by serial id
    //       $logs = Event_log::where('serial',$serial)->whereDate('MCGS_Time',$date)->get(); // get all event logs of the machine for the date.
        
    //       $totalErrors = 0;
    //       $validAssistArray = array();
   
    //       $startMark = $firstRow->output;
    //       $endMark = $firstRow->output + $interval;
    //       $intervalArray = array();
    //       $c = 0;
    //       foreach($logs as $log)
    //       {
    //         $c += 1;
    //         // if( $log->output >= $startMark && $log->output < $endMark)
    //         // {
    //         //   if( in_array($log->ERR_event,$assists))
    //         //   {
    //         //     //return "$log->ERR_event is in!";
    //         //     if( in_array($log->ERR_event,$intervalArray)){
    //         //       $intervalArray[$log->ERR_event] += 1;
    //         //     } else {
    //         //        $intervalArray[$log->ERR_event] = 1;
    //         //     }
                
    //         //       $validAssistArray[$log->ERR_event] = $intervalArray;
    //         //   }

    //         // } else {
    //         //   $startMark = $endMark;
    //         //   $endMark += $interval;

    //         // }

    //         if(in_array($log->ERR_event,$assists){
    //           if( $log->output >= $startMark && $log->output < $endMark){
    //             if( in_array($log->ERR_event,$intervalArray)){
    //               $intervalArray[$log->ERR_event] += 1;
    //              } else {
    //                $intervalArray[$log->ERR_event] = 1;
    //              }
    //           }
    //         }



    //       }
    //       return $c;
    //       return $validAssistArray;


    //       // foreach($assists as $a){
    //       //   if($a->output >= $startMark && $a->output < $endMark){
    //       //       array_push($errorArray, $a->ERR_event);
    //       //   } else {
    //       //       $startMark = $a->output;
    //       //       $endMark = $startMark + $interval;

    //       //       array_push($debugArray,$errorArray);
    //       //       $totalErrors += sizeof(array_unique($errorArray));
    //       //       $errorArray = array();
    //       //       array_push($errorArray, $a->ERR_event);


    //       //   }
    //       // }


    //     $result = (object)'';
    //     if($totalErrors == 0) { // in case total errors is zero
    //         $totalErrors = 1;}
    //     $result->muba = round($dayOutput/$totalErrors,2);
    //     $result->assists =  $totalErrors;
    //    return $result;

    // }

    public static function assistCodes($serial)
    {
      $machine = Machine::where('serial',$serial)->first();
      return $machine->mod->error->pluck('err_code'); // make result into array format
    }
     public static function totalOutput($serial,$from,$to){
        $max = Event_log::where('serial',$serial)->whereBetween('MCGS_Time',[$from,$to])->max('output');
        $min = Event_log::where('serial',$serial)->whereBetween('MCGS_Time',[$from,$to])->min('output');
        return $max - $min;
    }


}
