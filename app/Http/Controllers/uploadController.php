<?php

namespace App\Http\Controllers;

use App\Machines;
use App\Event_log;
use App\Work_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class uploadController extends Controller
{
    public function index()
    {
        $subheader = 'Data Import';
    	return view('upload.uploadForm',compact('subheader'));
    	
    }
    public function doUpload(Request $request){

    	$original = $request->file('csv_file');

    	$data = $this->csvToArray($original);

    	$this->insertEventLogs($data);
        $workLogs = $this->createWorkLogs($data);
        $this->insertWorkLogs($workLogs);

    	//dd(file_get_contents($original->getRealPath()));
    	return view('upload.csv',compact('data','workLogs'));
    }

    private function insertEventLogs($data)
    {
        foreach($data as $log) {
            if(!Event_log::where('MCGS_Time',$log['MCGS_Time'])->
                            where('MCGS_TIMEMS',$log['MCGS_TIMEMS'])->
                            where('serial',$log['serial'])->
                            where('ERR_event',$log['ERR_event'])->first())
            Event_log::insert($log);
        }
    }
    private function insertWorkLogs($data)
    {
        foreach($data as $log) {
            if(!Work_log::where('timeStart',$log['timeStart'])->
                            where('timeEnd',$log['timeEnd'])->
                            where('serial',$log['serial'])->
                            where('output',$log['output'])->first())
            Work_log::insert($log);
        }
    }

    private function createWorkLogs($data){
   
    	$workLog = array();
        $working = false;
        foreach($data as $row){

            if(stristr($row['ERR_event'],'START')){
           $working = true;
           $setCode = $row['TestSite_ON'];
           $timeStart = $row['MCGS_Time'];
           $qtyStart = $row['output'];
           $start = date_create($timeStart);
           
              } else {
                  if($working){
                      $working = false;
                     $timeStop = $row['MCGS_Time'];
                     $stop = date_create($timeStop);
                       $qtyStop = $row['output'];
                       $current = array(
                      'serial' => $row['serial'],
                     'customer' => $row['user_id'],
                     'customerId' => $row['user_id'],
                     'setCode' => $setCode,
                     'timeStart' => $timeStart,
                     'timeEnd' => $timeStop,
                     'workMinutes' => date_diff($start,$stop)->format('%i'),
                     'output' => $qtyStop-$qtyStart,
                     );
                     array_push($workLog,$current);
                     }
             }
         }
         return $workLog;
    } 

    private function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header) {
                //$header = $row;
            
            //custom head names
            	$header = ['MCGS_Time','MCGS_TIMEMS','serial','user_id','ERR_event','TestSite_ON','output'];
            } else {
                    if($row[6] != 0){
                         $data[] = array_combine($header, $row);
                    } 
                   
                    }
        }
        
        fclose($handle);
    }

    return $data;
}

	public function importCsv()
{
    $file = public_path('file/test.csv');

    $customerArr = $this->csvToArray($file);

    for ($i = 0; $i < count($customerArr); $i ++)
    {
        User::firstOrCreate($customerArr[$i]);
    }

    return 'Job done or what ever';    
}
}
