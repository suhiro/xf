<?php

namespace App\Http\Controllers;

use App\Machines;
use App\Work_log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class uploadController extends Controller
{
    public function index(){

    	return view('upload.do_upload');
    	//return Machines::all();
//    	return request()->input('task');
  //  	return DB::table('machines')->get();
    }
    public function doUpload(Request $request){

    	$original = $request->file('work_log');

    	$data = $this->csvToArray($original);
    	$this->insertCsv($data);

    	//dd(file_get_contents($original->getRealPath()));
    	return view('upload.csv',compact('data'));
    }

    private function insertCsv($data){
    	foreach($data as $d){
    		// if(!Work_log::findOrFail($d['serial']){
    			Work_log::insert($d);
    		// }
    		
    	}
    } 

    function csvToArray($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                //$header = $row;
            //custom head names
            	$header = ['serial','customer','customerId','setCode','timeStart','timeEnd','workMinutes','output'];
            else
                $data[] = array_combine($header, $row);
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

    return 'Jobi done or what ever';    
}
}
