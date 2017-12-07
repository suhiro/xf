<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    public function mod()
    {
    	return $this->belongsTo('App\Mod');
    }
}
