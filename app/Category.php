<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = ['name'];

	public function Feed()
	{
		return $this->hasMany('App\Feed');
	}

	public function Articles()
	{
		return $this->hasManyThrough('App\Article','App\Feed');
	}
}
