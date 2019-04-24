<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Kielabokkie\LaravelIpdata\Facades\Ipdata;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
   

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       $res= Ipdata::lookup();
       $country = $res->country_name;
       $city =  $res->city;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'city'=> $city,
            'country'=> $country,
            'role_id'=>roles()->associate(3),
        ]);
      
       
    }
    // public function verifyUser($token)
    // {
    //     $verifyUser = VerifyUser::where('token', $token)->first();
    //     if(isset($verifyUser) ){
    //         $user = $verifyUser->user;
    //         if($user->status== 0) {
    //         $verifyUser->user->status = 1;
    //         $verifyUser->user->save();
    //         $message = "Your e-mail is verified. You can now login.";
    //         } else {
    //         $message = "Your e-mail is already verified. You can now login.";
    //         }
    //     } else {
    //         return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    //     }
    //     return redirect('/login')->with('status', $status);
    // }
}
