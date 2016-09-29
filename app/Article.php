<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

	protected $fillable = [
		'title',
		'link',
		'comments',
		'pub_date',
		'creator',
		'category',
		'guid',
		'image',
		'image_list',
		'description',
		'content',
		'post_id',
		'feed_id',
	];

	public function Feed()
	{
		return $this->belongsTo('App\Feed');
	}

}
