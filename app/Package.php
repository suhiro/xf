<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['package','description'];

    public function machine()
    {
    	return $this->hasMany('App\Machine');
    }
}
