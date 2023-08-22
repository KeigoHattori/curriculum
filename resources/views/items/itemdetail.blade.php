@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <!-- 画面左側に商品画像 -->
            @if($item->item_image)
                <img src="{{ asset('storage/items/' . $item->item_image) }}" alt="{{ $item->item_name }}" class="img-fluid">
            @else
                <p>画像がありません</p>
            @endif

           <!-- 商品画像の下に「いいね」ボタン -->
     <!-- ユーザーがログインしている場合のみ表示 -->
     @auth
        <form action="{{ route('item.like', $item->id) }}" method="POST" novalidate>
            @csrf
            <button type="submit" class="btn btn-primary">
                @if (Auth::user()->likedItems->contains($item->id))
                    いいね解除
                @else
                    いいね
                @endif
            </button>
        </form>
    @endauth

            <!-- 「出品者」ボタン -->
            <a href="{{ route('user.profile', $item->user->id) }}" class="btn btn-secondary mt-2">出品者</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $item->item_name }}</h4>
                </div>
                <div class="card-body">
                    <!-- 商品情報 -->
                    <p><strong>価格:</strong> ¥{{ number_format($item->price) }}</p>
                    <p><strong>商品の状態:</strong> {{ $item->item_status }}</p>
                    <p><strong>商品の説明:</strong> {{ $item->item_description }}</p>

                    <!-- 表示を変更 -->
                    @if (!$item->isSold())
                        @if (Auth::check() && $item->user_id !== Auth::user()->id)
                            <!-- 「購入」ボタン -->
                            <a href="{{ route('item.purchase', $item->id) }}" class="btn btn-success">購入</a>
                        @endif
                    @else
                        <p class="text-danger">SOLD OUT</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
