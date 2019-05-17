<?php
use App\Video;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/videos', function () {
    return view('videos.index');
});


Auth::routes(['verify'=>true]);



Route::get('/home', 'HomeController@index')->name('home');
Route::resource('videos','VideosController');
Route::get('/watch?=','VideosController@show');
Route::get('/uploadvideo','VideosController@create')->name('upload');
Route::post('/profile', 'UserController@update_avatar');
Route::get('/users/{key}/profile','UserController@show');
Route::post('/upload','VideosController@store')->name('vstore');
Route::resource('comment','CommentsController');
Route::resource('replycomment','ReplyCommentsController');
Route::get('comment/{key}/edit','CommentsController@edit')->name('comments.edit');
Route::get('comment/{key}/delete','CommentsController@delete')->name('comments.delete');
Route::get('/funspot','VideosController@video');
Route::get('/latest_commedy','VideosController@latest')->name('latest');
Route::get('/trending_commedy','VideosController@trending')->name('trending');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('ajaxRequest', 'HomeController@ajaxRequest')->name('ajaxRequest');
Route::resource('likes','LikeController');

Route::any('/search', function () {
    $query = Input::get ('q');
    $v= Video::where('title', 'like', '%' . $query . "%")->orWhere('description','like','%'. $query .'%' )->orWhere('country','like','%'. $query.'%')->orwhere('tag','like','%'. $query .'%' )->orWhere('filename','like','%'. $query.'%' )->orWhere('producer','like','%'. $query.'%' )->get();
    
    if (count ($v) > 0){
        return view ( 'videos.search' )->withDetails ($v)->withQuery ( $query );
    }else{
        Session::flash('warning'," $query
         Not found. Check spelling!");
        return view ( 'videos.search' )->withDetails ( $v )->withMessage ( 'No Details found. Try to search again !' );
    }
} )->name('search');
Route::get('comment/like/{id}', ['as' => 'comment.like', 'uses' => 'LikeController@likeComment']);


//Admin Dashboard
Route::get('/admin_dash', 'AdminPanel\AdminPages@index')->name('admin-dash');

Route::get('/admin_dash/videos', 'AdminPanel\AdminPages@videos')->name('allv');
Route::get('/admin_dash/comments', 'AdminPanel\AdminPages@comments')->name('comments');

Route::get('/admin_dash/users', 'AdminPanel\AdminPages@users')->name('allu');
Route::get('/admin_dash/suggestions', 'AdminPanel\AdminPages@suggestions')->name('sug');


Route::get('/admin_dash/flagged-videos', 'AdminPanel\AdminPages@flagVideos')->name('fvideos');

Route::post('/block_user/{key}/block','UserController@block')->name('block');
Route::post('/unblock_user/{key}/unblock','UserController@unblock')->name('unblock');
Route::post('/flag_video/{key}/flag','FlagvideoController@flagged')->name('flag');
Route::post('/unflag_video/{key}/unflag','FlagvideoController@unflagged')->name('unflag');

//suggesstion box
Route::resource('suggestion','SuggesstionController');
Route::get('activity','AcitivityController@doactivity');

//for like video
Route::post('/like',['uses'=>'VideosController@likevideo', 'as' =>'like']);
Route::get('/countlike/{key}',['uses'=>'VideosController@countlike', 'as' =>'countlike']);
Route::get('/discount/{key}',['uses'=>'VideosController@countdislike', 'as' =>'discount']);




