<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Machine;
use App\Work_log;
use App\Event_log;
use App\Log;

class MachineReportController extends Controller
{
    public function machine(Request $r,$id)
    {
    	$machine = Machine::find($id);
    	$logs = Work_log::whereBetween('timeStart',[$r->start,$r->end])->get();
    	$stats['output'] = Work_log::where('serial',$machine->serial)
                        ->whereBetween('timeStart',[$r->start,$r->end])
                        ->sum('output');
        $stats['assists'] = DB::table('event_logs')->join('errors','event_logs.ERR_event','errors.err_code')->
                    where('serial',$machine->serial)->count();                

        $stats['time'] = Work_log::whereBetween('timeStart',[$r->start,$r->end])->sum('workMinutes');
       $stats['muba'] = Log::getMUBA($machine->serial,100,$r->start,$r->end);
        // if($stats['assists'] == 0) {
        //     $stats['muba'] = 0;
        // } else {
        //     $stats['muba'] = $status['output'] / $stats['assists'];
        // }
        
        $errors = $machine->mod->error->pluck('err_code')->toArray();
            
        $events = Event_log::where('serial',$machine->serial)->whereBetween('MCGS_Time',[$r->start,$r->end])->get();
        $machine->summary = Event_log::jamSummary($events,$errors);

        $outputs = Work_log::dailyOutput($machine->serial,$r->start,$r->end);
    	return view('report.machine.machine',compact('machine','stats','logs','outputs'));
    }
}
