<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Purchase;
use App\Item;
use App\User;

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
    public function destroy()
    {
       // 現在ログインしているユーザーを取得
    $user = Auth::user();

    // ユーザーに関連する商品を取得
    $items = $user->items;

    // ユーザーに関連する商品を削除
    foreach ($items as $item) {
        // 商品画像をストレージから削除（必要な場合）
        Storage::disk('public')->delete('items/' . $item->item_image);

        // 商品レコードを削除
        $item->delete();
    }

    // ユーザーレコードを削除
    $user->delete();

    // ホームページなど適切なページにリダイレクト
    return redirect()->route('login')->with('success', 'アカウントと関連する商品が削除されました');

    }

    //購入履歴
    public function purchaseHistory()
    {
        $user = Auth::user(); // 現在ログインしているユーザーを取得
        $purchaseHistory = Purchase::where('user_id', $user->id)
            ->with('item') // 関連する商品情報を取得
            ->orderByDesc('purchase_date')
            ->get(); // ユーザーの購入履歴を取得

        return view('mypage.purchase_history', compact('user', 'purchaseHistory'));
    }

    //売上履歴
    public function salesHistory()
    {
        $user = Auth::user();
        $salesHistory = Item::where('user_id', $user->id)
        ->with('purchases') 
        ->get();

        return view('mypage.sales_history', compact('user', 'salesHistory'));
    }

    //フォロー一覧
    public function following($id)
    {
        $user = User::findOrFail($id);
        $following = $user->following; // ユーザーがフォローしているユーザー一覧を取得

        return view('user.following', compact('user', 'following'));
    }

    //いいね一覧
    public function likedItems()
    {
        $user = Auth::user();
        $likedItems = $user->likedItems;
        
        return view('user.liked_items', compact('user', 'likedItems'));
    }
}
