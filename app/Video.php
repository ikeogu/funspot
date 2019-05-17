<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Video extends Model
{
    use Notifiable;
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
    

    protected $shareOptions = [
        'columns' => [
            'title' => 'title'
        ],
        'url' => null
    ];

    // public function getUrlAttribute()
    // {
    //     return route('videos.show', $this->slug);
    // }
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
