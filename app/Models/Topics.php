<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function Sections()
    {
    	return $this->belongsTo('App\Models\Sections', 'section', 'id');
    }

    public function Posts()
    {
    	return $this->hasMany('App\Models\Posts', 'topic', 'id');
    }
}
