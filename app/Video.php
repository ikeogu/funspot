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
    	return $this->hasMany('App\Comment','video_id');
    }

    

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
    
    

    public function latestVideo()
    {
        return $this->belongsTo(Latest::class);
    }
    public function flagvideos()
    {
        return $this->hasMany(FlagVideo::class,'flag');
    }
}
