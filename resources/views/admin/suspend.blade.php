@extends('layouts.app')

@section('content')
<div class="row justify-content-center"> 
    <!-- 左側 -->
    <div class="col-md-6"> 
        <div class="card mb-1">
            <div class="card-header">ユーザー名：{{ $user->name }}</div>
            <div class="card-body">
                @if ($user->user_icon)
                    <img src="{{ asset('storage/users/' . $user->user_icon) }}" alt="ユーザーアイコン" width="162">
                @else
                    <p>アイコンが未設定です</p>
                @endif
            </div>
            <!-- ユーザー非表示ボタン -->
            <!-- ユーザー非表示/再表示ボタン -->
            <div class="text-center mb-2">
                <form action="{{ route('toggle-user-status', $user->id) }}" method="POST" novalidate>
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        {{ $user->is_active ? 'ユーザー非表示' : 'ユーザー再表示' }}
                    </button>
                </form>
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
                            @if ($item->is_hidden)
                                <!-- 商品再表示ボタン -->
                                <form action="{{ route('item.unhide', $item->id) }}" method="POST" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success" onclick="return confirm('この商品を再表示にしますか？')">商品再表示</button>
                                </form>
                            @else
                                <!-- 商品非表示ボタン -->
                                <form action="{{ route('item.hide', $item->id) }}" method="POST" novalidate>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('この商品を非表示にしますか？')">商品非表示</button>
                                </form>
                            @endif
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
