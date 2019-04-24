<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\FlagVideo;
use App\User;
use App\Video;
class FlagvideoController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }
    public function flagged($id){
        $flag = Video::find($id);
       
        $flagv = new FlagVideo();
        
        $flagv->fuser()->associate(auth()->user()->id);
        $flagv->fvideos()->associate($flag);

        $flagv->save();
        
        return back()->with('success','You have flagged '.$flag->title) ; 
    }
    
      public function unflagged($id){
        $flag = Video::find($id);
        $flag->flag = 1;
        $flag->save();
      }
     
}
