<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得
        $items = $user->items; // ユーザーに関連付けられた商品を取得


        return view('mypage.index', compact('user', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
{
        // ログインしているユーザーの情報を取得する
        $user = Auth::user();
        return view('mypage.edit', compact('user'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
    // ログインしているユーザーを取得
    $user = Auth::user();
    

    // フォームから送信されたデータでユーザー情報を更新
    $user->name = $request->input('name');
    $user->self_introduction = $request->input('self_introduction');
    $user->email = $request->input('email');
    $user->full_name = $request->input('full_name');
    $user->phone_number = $request->input('phone_number');
    $user->postal_code = $request->input('postal_code');
    $user->address = $request->input('address');

    // ユーザーアイコンの処理
    if ($request->hasFile('user_icon') && $request->file('user_icon')->isValid()) {
        // ユーザーアイコンのファイルを保存
        $imagePath = $request->file('user_icon')->store('users', 'public');
        $user->user_icon = basename($imagePath);
    }

    // ユーザー情報を保存
    $user->save();

    // マイページにリダイレクト
    return redirect()->route('mypage.index')->with('success', 'プロフィールが更新されました');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
