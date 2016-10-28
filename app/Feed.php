<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed id
 */
class Feed extends Model
{
    protected $fillable = ['name', 'xmlUrl', 'htmlUrl', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function article()
    {
        return $this->hasMany('App\Article');
    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }
}
