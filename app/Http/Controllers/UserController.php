<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
         
        $userUpdate = User::where('id',$user->id)
            ->update([

                'name' => $request->input('name'),
                'email' => $request->input('email'),
                
                
        ]);
        if($userUpdate){
            return redirect()->route('home', ['id'=>Auth::user()->id]);
        
        }
        
        return back()->withInput();
       
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

    public function show($id){
        $u = User::find($id);
       
        return view('user.show',['u'=>$u]);
    }


    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user',$user));
    }
    public function update_avatar(Request $request){
        $request->validate([
            'passport' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $User = Auth::user();
        $avatarName = $User->id.'_avatar'.time().'.'.request()->passport->getClientOriginalExtension();
        $request->passport->storeAs('public/avatars',$avatarName);
        $User->passport = $avatarName;
        $User->save();
        return back()
            ->with('success','You have successfully uploaded your image.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function block($id){
        
        $user = User::find($id);

        if($user->status == Null){
           
            $user->status = 0;
            $user ->save();

            activity('Block')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties(['user_id' => 'id','user_id' => 'id'])
            ->log('BLocked '.$user->name);
        }
        return back()->withMessage('success', $user->name.' has been blocked');

    }
    public function unblock($id){

        $user = User::find($id);

        if($user->status == 0){
           
            $user->status = 1;
            $user ->save();
        }
        return back()->withMessage('success', $user->name.'has been Unblocked');

    }
}
