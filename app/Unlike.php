<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unlike extends Model
{
    public function unLikeVideo(){
        return $this->belongsTo('App\Video');
    }
   
}
