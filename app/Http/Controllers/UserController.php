<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registerUserView()
    {
        return view('user.register');
    }

    public function loginUserView()
    {
        return view('user.login');
    }

    public function loginUser(Request $request)
    {
        $checkExistence = User::where('email', $request->email)->first();
        if($checkExistence)
        {
            $validate = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required'
            ]);
            $logInData = $request->only('email', 'password');
            if(Auth::attempt($logInData)){
                return redirect()->route('activity.activity');
            } else {
                return view('user.login');
            }
        }
        return view('user.login');
    }

    public function logOutUser()
    {
        Auth::logout();
        
        return redirect()->route('user.login');
    }
}
