<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Machine;
use App\Event_log;
use App\Muba;
use Carbon\Carbon;

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
    public static function dayOutput($serial,$date)
    {
        $max = Event_log::where('serial',$serial)->whereDate('MCGS_Time',$date)->max('output');
        $min = Event_log::where('serial',$serial)->whereDate('MCGS_Time',$date)->min('output');
        return $max - $min;
    }

    public static function mubaByDate($serial,$interval,$date)
    {
      $machine = Machine::where('serial',$serial)->first();
      if(!$machine){
        return [ 'result'=> false,'error'=>"no machine identified by serial $serial"];
      }
      $event_logs = Event_log::where('serial',$serial)->whereDate('MCGS_Time',$date)->get(); // All logs for the given machine for the given period
      $validAssists = self::assistCodes($serial); // all valid for the machine model, identified by machine serial id
      $filteredLogs = $event_logs->whereIn('ERR_event',$validAssists); // all logs with only valid assist errors
      if(count($filteredLogs) == 0){
        return [ 'result'=> false,'error'=>"no valid assists for $serial on $date"];
      }
      
      $result = collect(); // collcection holding all result data
      $intervals = collect(); // collection form holding all output intevals
      $result->put('date',$date);

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
      $totalOutput = self::dayOutput($serial,$date);
      $result->put('machine_id',$machine->id);
      $result->put('totalOutput',$totalOutput);
      $result->put('totalValidAssists',$totalValidAssists);
      if($totalValidAssists == 0){
        $totalValidAssists = 1;
      }
      $muba = $totalOutput / $totalValidAssists;  // get the final MUBA!
      $result->put('muba',$muba);
      $result->put('result',true);

      return $result;
    }

    public static function storeMuba($serial,$interval,$date)
    {
      $result =  self::mubaByDate($serial,$interval,$date);
      if($result['result']){
        $muba = Muba::where('serial',$serial)->where('date',$date)->where('interval',$interval)->first();
        if($muba){
          $muba->minOutput = $result['min'];
          $muba->maxOutput = $result['max'];
          $muba->output = $result['totalOutput'];
          $muba->assists = $result['totalValidAssists'];
          $muba->save();
        } else {
          $muba = Muba::create([
            'machine_id' => $result['machine_id'],
            'serial' => $serial,
            'date' => $date,
            'minOutput' => $result['min'],
            'maxOutput' => $result['max'],
            'output' => $result['totalOutput'],
            'assists' => $result['totalValidAssists'],
            'muba' => $result['muba'],
            'interval' => $interval,
        ]);
        }
        return $muba;
      } else {
        return false;
      }  
    }
    public static function generateMuba($serial,$interval,$from,$to)
    {
      $dt = Carbon::createFromFormat('Y-m-d',$from);
      $count = 0;
      while($dt->toDateString() != $to){

        if(self::storeMuba($serial,$interval,$dt->toDateString()))
        {
          $count++;
        }
        $dt->addDay();
        
      }
      return $count;

    }


}
