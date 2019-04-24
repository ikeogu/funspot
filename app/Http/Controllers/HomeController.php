<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function videos()
    {
        $posts =Video::get();
        return view('videos.index', compact('posts'));
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequests(Request $request){


        $post = Video::find($request->id);
        $response = auth()->user()->toggleLike($post);


        return response()->json(['success'=>$response]);
    }

    public function users()
    {
        $users = User::get();
        return view('users', compact('users'));
    }


    /**
     * Show the application of itsolutionstuff.com.
     *
     * @return \Illuminate\Http\Response
     */
    public function user($id)
    {
        $user = User::find($id);
        return view('usersView', compact('user'));
    }


    /**
     * Show the application of itsolutionstuff.com.
     *
     * @return \Illuminate\Http\Response
     */
    public function ajaxRequest(Request $request){


        $user = User::find($request->user_id);
        $response = auth()->user()->toggleFollow($user);


        return response()->json(['success'=>$response]);
    }
}
