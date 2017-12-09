<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Machine;

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
                          $result[$log->ERR_event] = 1; 
                        } else {
                        $result[$log->ERR_event] += 1;
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
