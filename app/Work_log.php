<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work_log extends Model
{
    public static function aMethod(){
    	return true;
    }


/*
    $sql = "select * from lot_events where serial='$inSN' AND created_at>='$DateBefore'";
    $rows = $dbh->query($sql);
    $workLog = array();
    $working = false;
    foreach($rows as $row){

       if(stristr($row['ERR_event'],'START')){
           $working = true;
           $setCode = $row['TestSite_ON'];
           $timeStart = $row['created_at'];
           $qtyStart = $row['output'];
           $start = date_create($timeStart);
           
       } else {
           if($working){
               $working = false;
               $timeStop = $row['created_at'];
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

   //var_dump($workLog);
   ?>
   <table>
   <tr><th>Serial</th><th>customer</th><th>customerId</th><th>setCode</th><th>timeStart</th><th>timeEnd</th><th>workMinutes</th>><th>Output</th></tr>
   <?php foreach($workLog as $w):?>
      <tr> 
      <td><?=$w['serial']?></td>
      <td><?=$w['customer']?></td>
      <td><?=$w['customerId']?></td>
      <td><?=$w['setCode']?></td>
      <td><?=$w['timeStart']?></td>
      <td><?=$w['timeEnd']?></td>
      <td><?=$w['workMinutes']?></td>
      <td><?=$w['output']?></td>
      </tr>
   <?php endforeach;?>
   
   </table>
*/

}
