<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Machine;
use App\Error;

class Event_log extends Model
{
    public static function jams($machine,$start,$end)
    {
    	return Event_log;
    }

    public static function jamSummary($logs,$errors)
    {
    	if(sizeof($logs))
    	{
    		$result = array();
    		foreach($logs as $log){

                if( in_array($log->ERR_event,$errors) ){
                    if( !isset($result[$log->ERR_event]) )
                        {
                          $error =  Error::where('err_code',$log->ERR_event)->first();
                          $result[$log->ERR_event]['count'] = 1;
                          $result[$log->ERR_event]['description'] = $error->description; 
                          $result[$log->ERR_event]['component'] = $error->component;
                        } else {
                        $result[$log->ERR_event]['count'] += 1;
                        }
                }

    		
    		}
            arsort($result); //Sort Array (Descending Order), According to Value - arsort()
    		return $result;

    	} else {
    		return null;
    	}
    }
}
