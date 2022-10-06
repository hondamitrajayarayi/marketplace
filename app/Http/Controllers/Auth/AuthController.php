<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request){

        
        $cek = Auth::attempt(['username' => $request->username,'password'=>$request->password]);
        // dd($cek);
        if($cek){
            return redirect('/admin');
        }else{
            return redirect('/')->with('message','Email atau Password salah!');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
