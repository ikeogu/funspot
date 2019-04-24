<?php

namespace App;
use Overtrue\LaravelFollow\Traits\CanFollow;
use Overtrue\LaravelFollow\Traits\CanLike;
use Overtrue\LaravelFollow\Traits\CanFavorite;
use Overtrue\LaravelFollow\Traits\CanSubscribe;
use Overtrue\LaravelFollow\Traits\CanVote;
use Overtrue\LaravelFollow\Traits\CanBookmark;


use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use  Notifiable,CanFollow, CanBookmark, CanLike, CanFavorite, CanSubscribe, CanVote;
    const ADMIN_TYPE = 'admin';
    const MODERATOR = 'moderator';
    const DEFAULT_TYPE = 'user';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','country','city',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function videos(){
       return $this->hasMany(Video::class);
    }
    public function roles(){
        return $this->hasOne('App\Role');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
     }
     public function replycomments(){
        return $this->hasMany('App\ReplyComment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function verifyUser()
    {
    return $this->hasOne('App\VerifyUser');
    }

    public function flagvideo()
    {
    return $this->hasOne('App\FlagVideo');
    }

    public function suggestion(){
    return $this->hasMany('App\Suggestion');
    }
}
