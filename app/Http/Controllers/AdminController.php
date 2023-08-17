<?php

namespace App\Http\Controllers;
use App\Item;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $searchKeyword = $request->input('search'); // リクエストから検索キーワードを取得

        if ($searchKeyword) {
            // 検索キーワードがある場合はユーザーを絞り込む
            $users = User::where('name', 'LIKE', '%' . $searchKeyword . '%')->get();
        } else {
            // 検索キーワードがない場合は全ユーザーを取得
            $users = User::all();
        }

        return view('admin.dashboard', compact('users'));
    }

    public function suspendUser($userId)
    {
        $user = User::findOrFail($userId);
        $items = Item::where('user_id', $userId)->get();

        return view('admin.suspend', compact('user', 'items'));
    }

    public function toggleUserStatus($userId)
    {
        $user = User::findOrFail($userId);

        // 'is_active'カラムの値を切り替える
        $user->is_active = !$user->is_active;
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'ユーザーの状態を更新しました。');
    }

    public function hideItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        
        // 商品を非表示にする
        DB::table('items')->where('id', $itemId)->update(['is_hidden' => true]);
        
        return back()->with('success', '商品を非表示にしました。');
    }

    public function unhideItem($itemId)
    {
        $item = Item::findOrFail($itemId);
        
        // 商品を再表示にする
        DB::table('items')->where('id', $itemId)->update(['is_hidden' => false]);
        
        return back()->with('success', '商品を再表示しました。');
    }
}


