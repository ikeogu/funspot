<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function likeVideo(){
        return $this->belongsTo('App\Video');
    }
}
