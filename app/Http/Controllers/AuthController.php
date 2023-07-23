<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{
    public function login()
    {
        // ログイン画面の処理を記述する
        return view('auth.login'); // ログイン画面のBladeビューを返す例
    }
}
