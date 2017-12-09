<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
	protected $fillable = ['mod_id','component_id','err_code','description'];
    public function mod()
    {
    	return $this->belongsTo('App\Mod');
    }
    public function component()
    {
    	return $this->belongsTo('App\Component');
    }
}
