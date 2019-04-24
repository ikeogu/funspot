<?php
namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Video;
use App\User;
use App\Comment;
use App\ReplyComment;
use App\FlagVideo;
use App\Http\Controllers\Controller;
use App\Suggestion;

class AdminPages extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.index');
    }

    public function videos()

    {
        $allv = Video::all();
        
        return view('admin.videos',['allv'=>$allv]);
    }

    public function users()
    {
        $allu = User::all();
        return view('admin.users',['allu'=>$allu]);
    }

    public function flagVideos()
    {
        $flag =FlagVideo::with('fvideos','fuser')->get();
       
        return view('admin.flag-videos',['flag'=>$flag]);
    }
    public function comments()
    {
        $c= Comment::with('video')->get();
       return view('admin.comments',['c'=>$c]);
    }
    public function suggestions()
    {
        $c= Suggestion::with('user')->get();
        
       return view('admin.sugeestion',['c'=>$c]);
    }
}

