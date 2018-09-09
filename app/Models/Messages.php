<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
	protected $guarded = [];
	protected $dates = ['date'];
	public $timestamps = false;
	
	public function Users()
	{
		return $this->hasOne('App\Models\Users', 'id', 'from');
	}
	
	public function To()
	{
		return $this->hasOne('App\Models\Users', 'id', 'to');
	}

	public function messages()
	{
		return $this->hasMany('App\Models\Messages', 'line', 'line');
	}


}
