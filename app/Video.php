<?php

namespace App;
use Overtrue\LaravelFollow\Traits\CanBeLiked;
use Overtrue\LaravelFollow\Traits\CanBeFavorited;
use Overtrue\LaravelFollow\Traits\CanBeVoted;
use Overtrue\LaravelFollow\Traits\CanBeBookmarked;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use CanBeLiked, CanBeFavorited, CanBeVoted, CanBeBookmarked;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'tag','country','user_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   
    public function user(){
        return $this->belongsTo(User::class,'id');
     }
     public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    

    public function likes()
    {
        return $this->morphToMany('App\User', 'likeable')->whereDeletedAt(null);
    }
    
    public function getIsLikedAttribute()
    {
        $like = $this->likes()->whereUserId(Auth::id())->first();
        return (! is_null($like)) ? true : false;
    }

    public function latestVideo()
    {
        return $this->belongsTo(Latest::class);
    }
}
