<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Latest extends Model
{
    public function latestVideo()
    {
        return $this->hasOne(Video::class)->latest();
    }
}