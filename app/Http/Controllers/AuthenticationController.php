<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function save_user(Request $request){
        $this->validate($request,[
            'email'=> 'required|unique:users'
        ]);
     $new_user = new User();
     $new_user->name = $request->name;
     $new_user->email = $request->email;
     $new_user->password =  Hash::make($request->password);
     $new_user->role_id = 1;

     $new_user->save();
     session()->flash('user_saved', 'user saved successfully');
      return redirect()->back();

    }

 public function login(Request $request){
    if ($request->has('remember_me')) {
        $remember = true;
    }else{
        $remember = false;
    }
    $email = $request->email;
    $password = $request->password;
   
        if (Auth::attempt(['email'=>$email,'password' =>$password],$remember)) {
            return redirect()->route('dashboard');
        }else{ 
            session()->flash('invalid_auth_attempt','Wrong email or password');
            return redirect()->back();
        }

 }
}
