<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $guarded = [];

    public $timestamps = false;
    protected $dates = ['register', 'last_login', 'birth'];

    public function getRouteKeyName()
    {
        return 'login';
    }

    public function Groups()
    {
    	return $this->hasOne('App\Models\Groups', 'id', 'group');
    }

    public function Ranks()
    {
        return $this->hasOne('App\Models\Ranks', 'id', 'rank');
    }

    public function inbox()
    {
    	return $this->hasMany('App\Models\Messages', 'to', 'id');
    }

    public function outbox()
    {
    	return $this->hasMany('App\Models\Messages', 'from', 'id');
    }

    public function Reputations()
    {
    	return $this->hasManyThrough('App\Models\Reputations', 'App\Models\Posts', 'author', 'post', 'id');
    }

    public function Warns()
    {
    	return $this->hasManyThrough('App\Models\Warns', 'App\Models\Posts', 'author', 'post', 'id');
    }

    public function Posts()
    {
        return $this->hasMany('App\Models\Posts', 'author', 'id');
    }

    public function haveSectionRights(Sections $sekcja)
    {
        if( $this->groups->admin === 1 OR $this->groups->global === 1 OR $this->groups->section === $sekcja->id OR $sekcja->isChildOfModerator($this) )
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

//    static public function top()
//    {
//        return DB::table('Users')
//    }
}
