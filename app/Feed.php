<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    protected $fillable = ['name','xmlUrl','htmlUrl'];

		public function Article()
		{
			return $this->hasMany('App\Article');
		}
}
