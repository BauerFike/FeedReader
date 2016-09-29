<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['url','height','width','description','article_id'];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }
}
