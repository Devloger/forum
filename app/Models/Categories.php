<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = "categories";
    protected $primarykey = 'id';
    public $timestamps = false;

    public function Sections()
    {
    	return $this->hasMany('App\Models\Sections', 'category');
    }
}
