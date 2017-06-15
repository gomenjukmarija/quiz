<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Image;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {        
       $this->middleware('auth');       
    }
    
    public function users()  {
        $users = User::all();
        return view('user.user',compact('users'));
    }

    public function profile(){
        return view('profile', array('user' => Auth::user()) );
    }
    
    public function update_avatar(Request $request){
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename ) );
            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        return view('profile', array('user' => Auth::user()) );
    }
}
