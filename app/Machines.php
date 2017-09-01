<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    //
    public function models(){
    	return App\Machines::pluck('model');
    }
}
