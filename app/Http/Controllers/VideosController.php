<?php

namespace App\Http\Controllers;
use App\Video;
use Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use FFMPEG;
use Uuid;
use FFMpeg\FFProbe;
use Illuminate\Support\Facades\File;
use Kielabokkie\LaravelIpdata\Facades\Ipdata;

class VideosController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
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
        $video =Video::find($video->id);
        
        
        
        return view('videos.show', ['video'=>$video]);
        
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

  //   public function uploadSubmit(UploadRequest $request)
  // {
  //   if ($request->hasFile('video')) {
  //         $randName = Carbon::now()->timestamp;
  //         $uploadDir = '/uploads/';
  //         $location = $randName . '.mp4';
  //         $fullPath = public_path() . $uploadDir . $location;
  //         // check if 'uploads/' directory exists. If not, create it.
  //         if(!File::exists(public_path() . $uploadDir)) {
  //           File::makeDirectory(public_path() . $uploadDir, $mode = 0777, true, true);
  //         }
  //         $file = $request->file('video');
  //         $file->move(public_path() . $uploadDir, $location);
  //         $title = $request->input('title');
  //         // get video thumbnail
  //         FFMpeg::fromDisk('upload')
  //           ->open($location)
  //           ->getFrameFromSeconds(10)
  //           ->export()
  //           ->toDisk('upload')
  //           ->save($randName . '.png');
  //         // get video duration
  //         $ffprobe = FFProbe::create();
  //         $duration = $ffprobe->format($fullPath)
  //           ->get('duration');
  //         $duration = Carbon::createFromTimestampUTC($duration)
  //           ->toTimeString();
  //         // get video filesize
  //         $filesize = File::size($fullPath);
  //         $filesize = $this->formatBytes($filesize);
  //         // get video bitrate
  //         $bitrate = $ffprobe->format($fullPath)
  //           ->get('bit_rate');
  //         $bitrate = $this->formatBytes($bitrate);
  //         $video = new Video();
  //         $video->title = $title;
  //         $video->filename = htmlspecialchars($file->getClientOriginalName());
  //         $video->location = $uploadDir . $location;
  //         $video->thumbnail = $uploadDir . $randName . '.png';
  //         $video->duration = $duration;
  //         $video->filesize = $filesize;
  //         $video->bitrate = $bitrate;
  //         $video->producer = auth()->user()->name;
  //           $res = Ipdata::lookup();
  //         $video->country = $res->country_name;
           
  //         $video->save();
  //         return redirect('/')
  //           ->withSuccess('Successfully uploaded!')
  //           ->with([
  //             'title' => $title
  //           ]);
      //}
  //}
  // private functions
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
        
        $path = $video_file->storeAs('public/video-bank', $fileToUpload);
        // other php codes to generate video random string id and save it with video meta to the database.

         
        
        // $duration = $ffprobe->format($fileToUpload)
        //   ->get('duration');
        // $duration = Carbon::createFromTimestampUTC($duration)
        //   ->toTimeString();
        // // get video filesize
        // $filesize = File::size($fileToUpload);
        // $filesize = $this->formatBytes($filesize);
        // // get video bitrate
        // $bitrate = $ffprobe->format($fileToUpload)
        //   ->get('bit_rate');
        // $bitrate = $this->formatBytes($bitrate);
        // //creating an instance of video class
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
       // $res= Ipdata::lookup();
       //$country = $res->country_name;
       // $video->country = $country;
        $video->user_id = auth()->user()->id;
         
        $video->save();
        return back()
          ->withSuccess('Successfully uploaded!')
          ->with([
            'title' => $title
          ]);

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
