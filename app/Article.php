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

	public function Category()
    {
		// return $this->belongsTo('App\Category');
		// return $this->belongsTo('App\Feed')->getResults()->category();
		$feed = $this->belongsTo('App\Feed','feed_id');
		return $feed->getResults()->hasMany('App\Category','category_id');
        // return $this->belongsToThrough('App\Feed', 'App\Category');
    }

}
