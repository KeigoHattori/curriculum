<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;

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
         return view('items.index', compact('items'));
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
            'item_name' => 'required|max:30',//（出品名）: 必須フィールドであり、最大30文字まで入力可能
            'price' => 'required|numeric|min:0|max:999999999',//（価格）: 必須フィールドであり、0以上999,999,999以下の数値
            'item_description' => 'max:300',//（商品説明）: 最大300文字まで入力可能
            'item_status' => 'required|max:10',//（商品の状態）: 必須フィールドであり、最大10文字まで入力可能
        ]);

        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', '商品を登録しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
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
