<?php

namespace App\Http\Controllers;
use App\Item;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $items = Item::all();

        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_admin == 1) {
                return redirect()->route('admin.dashboard'); // 管理者の場合は管理画面へ
            } elseif (!$user->is_active) {
                Auth::logout(); // ログアウト
                return redirect()->route('login')->with('error', 'アカウントは非表示にされています。');
            }
        }

        return view('homeblade', compact('items'));
    }
}
