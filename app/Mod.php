<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
    public function machine()
    {
    	return $this->hasMany('App\Machine');
    }
}
