<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Item;
use App\Purchase;
use App\User;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function search(Request $request)
     {
        $keyword = $request->input('keyword');
        $price = $request->input('price');
    
        $query = Item::query(); // Item モデルを使ってクエリを構築
    
        if ($keyword) {
            $query->where(function ($query) use ($keyword) {
                $query->where('item_name', 'like', "%$keyword%")
                      ->orWhere('item_description', 'like', "%$keyword%");
            });
        }
    
        if ($price) {
            $query->where('price', '<=', $price);
        }
    
        $items = $query->get();
    
        return view('homeblade', compact('items')); // ホームページに戻る
    }


    public function index()
    {
         // 商品一覧を取得し、作成日時の昇順で並び替える
        $items = Item::orderBy('created_at', 'asc')->get();

        // 商品一覧を表示するビューにデータを渡す
        return view('home', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //商品の登録のフォーム表示
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // 商品の登録処理
    $validatedData = $request->validate([
        'item_name' => 'required|max:30',
        'price' => 'required|numeric|min:0|max:999999999',
        'item_description' => 'max:300',
        'item_status' => 'required|max:10',
        'item_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ログインしているユーザーのIDを取得
    $user_id = Auth::id();

    // アップロードされた画像を処理する
    if ($request->hasFile('item_image') && $request->file('item_image')->isValid()) {
        $imagePath = $request->file('item_image')->store('items', 'public');
        $validatedData['item_image'] = basename($imagePath);
    }

    // Itemモデルを作成してuser_idを設定
    $item = new Item($validatedData);
    $item->user_id = $user_id;
    $item->save();

    return redirect()->route('home')->with('success', '商品を登録しました');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    // 商品詳細を取得
    $item = Item::find($id);

    if (!$item) {
        abort(404); // 商品が見つからない場合は404エラーを表示
    }

    return view('items.itemdetail', compact('item'));
    
}

//出品者
public function showProfile($userId)
    {
        // ユーザー情報を取得
    $user = User::find($userId);

    if (!$user) {
        abort(404); // ユーザーが見つからない場合は404エラーを表示
    }

    return view('user.profile', compact('user'));
    }

public function showPurchase($id)
{
    $item = Item::find($id);

    if (!$item) {
        abort(404);
    }

    // ユーザーの情報を取得
    $user = Auth::user();

    // ユーザーの情報を取得
    $user = Auth::user();

    return view('items.purchase_form', compact('item', 'user'));
}

public function purchase(Request $request, $id)
{
    $validatedData = $request->validate([
        'full_name' => 'required|max:10',
        'phone_number' => 'required|max:20',
        'postal_code' => 'required|max:20',
        'address' => 'required',
    ]);

    $user = Auth::user();

    // 購入情報を保存
    $purchase = new Purchase([
        'user_id' => $user->id,
        'item_id' => $id,
        'purchase_date' => now(),
    ]);
    $purchase->save();

    // ユーザー情報を更新
    $user->update([
        'full_name' => $validatedData['full_name'],
        'phone_number' => $validatedData['phone_number'],
        'postal_code' => $validatedData['postal_code'],
        'address' => $validatedData['address'],
    ]);

    return redirect()->route('home')->with('success', '商品を購入しました');
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|max:30',
            'price' => 'required|numeric|min:0|max:999999999',
            'item_description' => 'max:300',
            'item_status' => 'required|max:10',
            'item_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // ログインしているユーザーのIDを取得
        $user_id = Auth::id();
    
        // アップロードされた画像を処理する
        if ($request->hasFile('item_image') && $request->file('item_image')->isValid()) {
            $imagePath = $request->file('item_image')->store('items', 'public');
            $validatedData['item_image'] = basename($imagePath);
        }
    
        // ユーザーIDと更新したい商品情報を設定
        $item->user_id = $user_id;
        $item->update($validatedData);
    
        return redirect()->route('mypage.index')->with('success', '商品が更新されました');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // アイテムを削除
        $item->delete();

        // 削除後にページにリダイレクト（例: ホームページ）します
        return redirect()->route('mypage.index')->with('success', '商品が削除されました');
    }

    //  フォロー機能
    public function follow(User $user)
    {
        Auth::user()->following()->attach($user->id);
        return back()->with('success', 'フォローしました');
    }

    public function unfollow(User $user)
    {
        Auth::user()->following()->detach($user->id);
        return back()->with('success', 'フォローを解除しました');
    }

    //いいね機能
    public function like(Item $item)
    {
        $user = Auth::user();

        if (!$user->likedItems->contains($item->id)) {
            $user->likedItems()->attach($item->id);
            return back()->with('success', '商品にいいねしました');
        } else {
            $user->likedItems()->detach($item->id);
            return back()->with('success', '商品のいいねを解除しました');
        }
    }

    
}
