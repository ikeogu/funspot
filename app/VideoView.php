<?php

namespace App;
use App\Video;

use Illuminate\Database\Eloquent\Model;

class VideoView extends Model
{
    public static function createViewLog($video) {
        $videoViews= new videoView();
        $videoViews->video_id = $video->id;
        $videoViews->title = $video->title;
        $videoViews->url = \Request::url();
        $videoViews->session_id = \Request::getSession()->getId();
        $videoViews->user_id = (\Auth::check())?\Auth::id():null; //this check will either put the user id or null, no need to use \Auth()->user()->id as we have an inbuild function to get auth id
        $videoViews->ip = \Request::getClientIp();
        $videoViews->agent = \Request::header('User-Agent');
        $videoViews->save();//please note to save it at lease, very important
    }
}
