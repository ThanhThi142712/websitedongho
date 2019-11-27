<?php

namespace App\Http\Controllers\backend;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Request;



class LoginUser extends Controller
{
    function getdangnhap(){
        return view('frontend.loginuser');
    }
    function postdangnhap(){
        $username = Request::input('username');
        $password = Request::input('password');
        $datauser=['name'=>$username,'password'=>$password,'access'=>2];
        
      
        if(Auth::attempt($datauser)){
            Request::session()->put('loginuser', true);
            Request::session()->put('name', 'fullname');
            
            return redirect()->route('user');
        }
        else {
            return redirect()->route('loginuser')->with('fail', 'Đăng nhập không thành công, sai username hoặc password.');
        }
    }
    function dangxuat(){
       
        if(Auth::check())
        {
            Auth::logout();
            
        }
        Request::session()->flush();
        return view('frontend.loginuser');
    }
}
