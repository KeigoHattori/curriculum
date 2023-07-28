<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        // ログイン画面の処理を記述する
        return view('auth.login'); // ログイン画面のBladeビューを返
    }

     // ログアウト処理
     public function logout(Request $request)
     {
         Auth::logout();
         return redirect()->route('login');
     }
}
