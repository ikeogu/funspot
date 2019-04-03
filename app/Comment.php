<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    public function video()
   {
   	return $this->belongsTo('App\Video');
   }
   public function user()
   {
   	return $this->belongsTo('App\User');
   }
   public function recomments(){
    return $this->hasMany('App\ReplyComment');
 }
}
