<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Item;

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
 
         // データベースから検索条件に合致する商品を取得するクエリを作成
         $query = Item::query();
 
         if ($keyword) {
             $query->where('item_name', 'like', '%' . $keyword . '%')
                 ->orWhere('item_description', 'like', '%' . $keyword . '%');
         }
 
         if ($price) {
             $query->where('price', '<=', $price);
         }
 
         // クエリを実行し、結果を取得
         $items = $query->get();
 
         // 検索結果をhome.blade.phpに渡して表示
         return view('home', compact('items'));
     }


    public function index()
    {
         // 商品一覧を取得
         $items = Item::all();

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


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }
}
