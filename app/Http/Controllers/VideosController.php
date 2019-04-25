<?php

namespace App\Http\Controllers;
use App\Video;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use FFMPEG;
use Uuid;
use DB;
use FFMpeg\FFProbe;
use App\Like;
use App\Latest;
use App\VideoView;
use Illuminate\Support\Facades\File;
use Kielabokkie\LaravelIpdata\Facades\Ipdata;
use Spatie\Activitylog\Models\Activity;

class VideosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show','latest','trending']);
    }
   
    public function index()
    {
        
        $video = Video::all();
       
       return view('videos.index',['video'=>$video]);
      
     }
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::check();
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        $video = Video::find($video->id);
        $user = 3;
        \App\VideoView::createViewLog($video);
        activity('Watched')
        ->performedOn($video)
        ->causedBy($user)
        ->withProperties(['user_id' => 'id','videos_id' => 'id'])
        ->log('Viewed '.$video->title);
        
        return view('videos.show', ['video'=>$video]);
        
    }

    public function trending(Video $video)
    {

        //or add `use App\PostView;` in beginning of the file in order to use only `PostView` here 

        $video = Video::join("video_views", "video_views.id", "=", "videos.id")
            
            ->groupBy("videos.id")
            ->orderBy(DB::raw('COUNT(videos.id)'> 20), 'desc')->get([DB::raw('COUNT(videos.id) as total_views'), 'videos.*']);
            return view('videos.trending',['video'=>$video]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function latest(){
        $ls= Video::orderBy('created_at', 'desc')->orderBy('id', 'asc')->get();
       
        return view('videos.latest',['ls'=>$ls]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

  
  private function formatBytes($size, $precision = 2)
  {
      $base = log($size, 1024);
      $suffixes = array('', 'K', 'M', 'G', 'T');
      return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
  }

    public function store(Request $request)
    {
        
        $req = $request->all();
                        
        // get video title
        $title = $req['title'];
        // get video description
        $desc = $req['desc'];
        // get video tags
        $tags = $req['tags'];
        //video thumnail data
        
        $thumbnail = $req['v_thumbnail'];
        //get video file object
        $video_file = $req['v_file'];
        //get mimetype of video
        $fileMimeType = $request->file('v_file')->getMimeType();

        // get video file name with ext
         $fileNameWithExt = $video_file->getClientOriginalName();
        // get video file name, no ext
         $video_file_name = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // get video ext;
        $ext = $video_file->getClientOriginalExtension();
        // strip unwanted characters from file name and convert it to file link
        $stripedFileName = $this->linkify($video_file_name);
        // new file link to upload
         $fileToUpload = $stripedFileName.'_'.time().'.'.$ext;
        // upload video to server
        // $pa =  $this->linkify($thumbnail);
        // $thumbnail->storeAs("public/video-bank/thumbnails",$pa);
        
       
        // other php codes to generate video random string id and save it with video meta to the database.

       
        $video = new Video();
        $video->title = $title;
        $video->tag = $tags;
        $video->description = $desc;
        $video->video_file = $fileToUpload;
        $video->format =   $fileMimeType;
        $video->filename = $video_file_name;
        //$video->location = $uploadDir . $location;
         $video->thumbnail = $thumbnail;
        // $video->duration = $duration;
        // $video->filesize = $filesize;
        // $video->bitrate = $bitrate;
        $video->video_link = uniqid();
        $video->producer = auth()->user()->name;
       
        $video->user_id = auth()->user()->id;
        $user = User::find($video->user_id);
         
        $user->videos()->saveMany([$video]);
        
        // $lv = new Latest();
        
        // $video->latestVideo()->update([$lv]);
        // $lv->save();
        print_r($video->id);
        $path = $video_file->storeAs('public/video-bank', $fileToUpload);
        return back()
          ->withSuccess('Successfully uploaded!')
          ->with([
            'title' => $title
          ]);

        //to activity check
        activity('Upload')
        ->performedOn($video)
        ->causedBy($user)
        ->withProperties(['user_id' => '$user','videos_id' => '$video->id'])
        ->log('Uploaded '.$video->title);
          

    }
    
    public function linkify($name) {
    $va = '';
    $ra = '';

    preg_match_all('/(\b\w+\b)/', $name, $matches);

    foreach ($matches[1] as $value) {
      $va .= $value." ";
    }

    $stripedtitle = preg_replace("/\s/Uim", "-", $va);

    $sname = preg_replace('/(-$)/', '', $stripedtitle);

    preg_match_all('/([a-z0-9A-Z-])/', $sname, $mat);
    foreach ($mat[1] as $value) {
      $ra .= $value;
    }
    return $ra;
  }

 
}
