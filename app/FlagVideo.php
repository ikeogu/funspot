<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlagVideo extends Model
{
    public function fvideos()
    {
        return $this->belongsTo(Video::class);
    }
    public function fuser()
    {
        return $this->belongsTo(User::class);
    }
}
