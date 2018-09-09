<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warns extends Model
{	
	public function Posts()
    {
    	return $this->belongsTo('App\Models\Posts', 'post', 'id');
    }

    public function Users()
    {
    	return $this->belongsTo('App\Models\Users', 'from', 'id');
    }
}
