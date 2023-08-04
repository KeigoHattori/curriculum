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
Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.index');//マイページ
Route::get('/edit', [MyPageController::class, 'edit'])->name('edit-profile');
//マイページ編集
Route::put('/mypage/{id}', [MyPageController::class, 'update'])->name('mypage.update');
Route::get('/delete-account', [MyPageController::class, 'deleteAccount'])->name('delete-account');//マイページ退会



Route::get('/login', [AuthController::class, 'login'])->name('login'); // ログイン画面へのルート
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');// ログアウト処理
Route::get('/exhibit', [ItemController::class, 'create'])->name('exhibit'); // 出品画面へのルート
Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.details'); // 商品詳細ページ
Route::get('/search', [ItemController::class, 'search'])->name('search'); // 検索処理

