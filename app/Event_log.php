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

    public static function jamSummary($logs)
    {
    	if(sizeof($logs))
    	{
    		$result = array();
    		foreach($logs as $log){

    			if( !isset($result[$log->ERR_event]) )
    			{
    				$result[$log->ERR_event] = 1;
    			} else {
    				$result[$log->ERR_event] += 1;
    			}

    		}
    		return $result;

    	} else {
    		return null;
    	}
    }
}
