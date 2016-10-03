<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = ['name','xmlUrl','htmlUrl','category_id'];

		public function Article()
		{
			return $this->hasMany('App\Article');
		}

		public function Category()
		{
			return $this->belongsTo('App\Category');
		}
}
