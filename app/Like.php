<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Like extends Model
{
    use SoftDeletes;
    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'video_id',
        'like',
    ];
    /**
     * Get all of the products that are assigned this like.
     */
    public function comments()
    {
        //return $this->morphedByMany('App\Comment', 'likeable');
    }
    /**
     * Get all of the posts that are assigned this like.
     */
    public function video()
    {
        return $this->belongsTo('App\Video');
    }

     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
