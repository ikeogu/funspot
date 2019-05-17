<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Video;
use Session;
use Auth;
use App\Comment;
class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            
            'body' => 'required|min:5|max:2000'
            ));
        $vid = $request->id;
        $video = Video::find($vid);
        $comment = new Comment();
        $comment->user()->associate(auth()->user()->id);
        $comment->email =auth()->user()->email;
        $comment->video()->associate($video);
        $comment->body = $request->body;
        $comment->save();
        Session::flash('success', 'Comment was added');
        return redirect()->route('videos.show', [$video->id]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $comment = Comment::find($id);
      return view('comment.edit')->withComment($comment);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $this->validate($request, array('body' => 'required'));
        
        $comment->body = $request->body;
        $comment->save();
        Session::flash('success', 'Comment updated');
        return redirect()->route('videos.show', $comment->video->id);
    }
    public function delete($id)
    {
        $comment = Comment::find($id);
        return view('comment.delete')->withComment($comment);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $video_id = $comment->video->id;
        $comment->delete();
        Session::flash('success','Deleted Comment');
        
        return redirect()->route('videos.show', $video_id);
    }
    public function likecomment(Request $request){
        $comment_id = $request['commentId'];
        $is_like = $request['islike'];
        $update = false;
        $comment = Comment::find($comment_id);
        if(!$comment){
            return null;
        }
        $user = Auth::user();
        $like =$user->likes()->where('comment_id',$comment_id)->first();
        if($like){
            $already_like = $like->like;
            $update =true;
            if($already_like == $is_like){
                $like->delete();
                return null;
            }
        }else{
            $like = new CommentLike();
 
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->comment_id = $video->id;
        if($update){
            $like->update();
 
        }else{
            $like->save();
            return null;
        }
    }
}
