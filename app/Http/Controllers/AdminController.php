<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{


    public function login(Request $request){

        $remember_me = $request->has('remember-me')? true : false;
       if(Auth::attempt([
           'name'=>$request->username,
           'password'=>$request->password,
       ], $remember_me)) {
           return redirect()->to('home');
       }else{

           return view('login');
       }
    }
}
