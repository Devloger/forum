<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{
    public function Users()
    {
    	return $this->belongsTo('App\Models\Users', 'id', 'rank');
    }
}
