<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mod extends Model
{
	protected $fillable = ['name','package_id','description'];
    public function machine()
    {
    	return $this->hasMany('App\Machine');
    }
    public function error()
    {
    	return $this->hasMany('App\Error');
    }
    public function package()
    {
    	return $this->belongsTo('App\Package');
    }
    public function component()
    {
        return $this->hasMany('App\Component');
    }
}
