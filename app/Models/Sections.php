<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sections extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return 'url';
    }

    public function Categories()
    {
    	return $this->belongsTo('App\Models\Categories', 'category');
    }

    public function Topics()
    {
    	return $this->hasMany('App\Models\Users', 'section', 'id');
    }

    public function Posts()
    {
    	return $this->hasManyThrough('App\Models\Posts', 'App\Models\Topics', 'section', 'topic', 'id');
    }

    public function isChildOfModerator(Users $user)
    {
        $x = 0;
        if( $this->parent === NULL )
        {
            $x = 0;
        }
        else
        {
            if( $this->parent === $user->groups->section )
            {
                $x = 1;
            }
            else
            {
                $x = Sections::where('id', $this->parent)->first()->isChildOfModerator($user);
            }
        }
        return $x;
    }
}