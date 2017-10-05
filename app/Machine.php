<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    public function Factory()
    {
    	return $this->belongsTo('App\Factory');
    }
}
