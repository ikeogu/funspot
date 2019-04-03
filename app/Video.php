<?php

namespace App;



use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    
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
        return $this->belongsTo()('App\User');
     }
     public function comments()
    {
    	return $this->hasMany('App\Comment');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function unlikes(){
        return $this->hasMany('App\Unlike');
    }
}
