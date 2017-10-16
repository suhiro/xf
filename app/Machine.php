<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Machine extends Model
{
    public function Factory()
    {
    	return $this->belongsTo('App\Factory');
    }

    public function mod()
    {
    	return $this->belongsTo('App\Mod');
    }

    public static function output($date,$serial)
    {
         $output = DB::table('event_logs')
                    ->select(DB::raw('max(output)-min(output) as output'))
                    ->where('serial',$serial)
                        ->whereDate('MCGS_Time',$date)
                        ->value('output');
        return $output;
    
    }
}
