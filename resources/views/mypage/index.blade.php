@extends('layouts.app')

@section('content')
<div class="row justify-content-center"> 
        <!-- 左側 -->
        <div class="col-md-6"> 
            <div class="card mb-1">
            <div class="card-header">ユーザー名：{{ $user->name }}
            <div class="text-center">
            <!-- 編集ボタン -->
            <a href="{{ route('edit-profile', ['id' => Auth::user()->id]) }}" class="btn btn-primary">編集</a>
            <!-- 退会ボタン -->
            <a href="{{ route('delete-account') }}" class="btn btn-danger" onclick="return confirm('アカウントを削除しますか？')">退会</a>
        </div>
            </div>
                <div class="card-body">
                    @if ($user->user_icon)
                        <img src="{{ asset('storage/users/' . $user->user_icon) }}" alt="ユーザーアイコン" width="162">
                    @else
                        <p>アイコンが未設定です</p>
                    @endif
                </div>
                <!-- リンク -->
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('liked-items') }}">いいねした出品一覧</a>
                        </div>
                        <div class="col">
                            <a href="{{ route('purchase-history') }}">購入履歴</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('user.following', $user->id) }}">フォロー一覧</a>
                        </div>
                        <div class="col">
                            <a href="{{ route('sales-history') }}">売上履歴</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 右側 -->
        <div class="col-md-4"> 
            <div class="card mb-3">
                <div class="card-header">プロフィール</div>
                <div class="card-body">
                    <p>{{ $user->self_introduction }}</p>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">メールアドレス</div>
                <div class="card-body">
                    <p>{{ $user->email }}</p>
                </div>
            </div>
        </div>

    <!-- 画面下部 -->
    <div class="row justify-content-left"> 
        @if ($items->count() > 0)
            @foreach ($items as $item)
                <div class="col-md-3 mb-2">
                    <div class="card" style="height: 100%;">
                        <img src="{{ asset('storage/items/' . $item->item_image) }}" alt="商品画像" style="height: 250px;"> 
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->item_name }}</h5>
                            <p class="card-text">価格: ¥{{ number_format($item->price) }}</p>
                            @if ($item->isSold())
                            <p class="card-text"><strong class="text-danger">SOLD OUT</strong></p>
                            @endif
                            <a href="{{ route('item.details', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                            <a href="{{ route('item.edit', $item->id) }}" class="btn btn-secondary">編集</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
        <div class="col-md-14 row justify-content-center">
            <p class="text-center" style="font-size: 300%;">商品はありません。</p>
        </div>
         @endif

        
    </div>
    
</div>
@endsection
