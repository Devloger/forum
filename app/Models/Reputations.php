<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reputations extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function Posts()
    {
    	return $this->belongsTo('App\Models\Posts', 'post', 'id');
    }

    public function Users()
    {
    	return $this->belongsTo('App\Models\Users', 'from', 'id');
    }

    public function reputators()
    {
        return $this->hasMany('App\Models\Users', 'id', 'from');
    }
}
