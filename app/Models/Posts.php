<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $dates = ['date'];
    protected $guarded = [];
    public $timestamps = false;

    public function Topics()
    {
    	return $this->belongsTo('App\Models\Topics', 'topic', 'id');
    }

    public function Users()
    {
    	return $this->belongsTo('App\Models\Users', 'author', 'id');
    }

    public function reputations()
    {
        return $this->hasMany('App\Models\Reputations', 'post', 'id');
    }

}
