<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MyPageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

// ホームページのルート
Route::get('/home', [HomeController::class, 'index'])->name('home');

// リソースコントローラー
Route::resource('items', 'ItemController');

Route::get('/login', [AuthController::class, 'login'])->name('login'); // ログイン画面へのルート
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');// ログアウト処理

//マイページ
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');//マイページ
Route::get('/edit', [MyPageController::class, 'edit'])->name('edit-profile');
Route::put('/mypage/{id}', [MyPageController::class, 'update'])->name('mypage.update');//マイページ編集
Route::get('delete-account', [MyPageController::class, 'destroy'])->name('delete-account');//マイページ退会
Route::get('/purchase-history', 'MyPageController@purchaseHistory')->name('purchase-history');//購入履歴
Route::get('/sales-history', 'MyPageController@salesHistory')->name('sales-history');//売上履歴


//商品
Route::get('/exhibit', [ItemController::class, 'create'])->name('exhibit'); // 出品画面へのルート
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.details'); // 商品詳細ページ
Route::get('/search', [ItemController::class, 'search'])->name('search'); // 検索処理
Route::get('/item/{item}/edit', [ItemController::class, 'edit'])->name('item.edit');//商品編集
Route::put('/item/{item}', [ItemController::class, 'update'])->name('item.update');//商品編集
Route::delete('/item/{item}', [ItemController::class, 'destroy'])->name('item.destroy');//商品削除
Route::get('/item/{id}/purchase', [ItemController::class, 'showPurchase'])->name('item.purchase');//商品購入
Route::post('/item/{id}/purchase', [ItemController::class, 'purchase'])->name('item.purchase.submit');//商品購入
Route::get('/user/profile/{userId}', 'ItemController@showProfile')->name('user.profile');//出品者
Route::post('/user/{user}/follow', 'ItemController@follow')->name('user.follow');//フォロー機能
Route::delete('/user/{user}/unfollow', 'ItemController@unfollow')->name('user.unfollow');//フォロー機能
Route::get('/user/{id}/following', [MyPageController::class, 'following'])->name('user.following'); // フォロー一覧
Route::post('/item/{item}/like', [ItemController::class, 'like'])->name('item.like');//いいね機能
Route::get('/liked-items', [MyPageController::class, 'likedItems'])->name('liked-items');//いいねした出品一覧


