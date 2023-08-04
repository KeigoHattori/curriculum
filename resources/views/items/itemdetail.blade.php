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
                <button class="btn btn-primary mt-2">いいね</button>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $item->item_name }}</h4>
                    </div>
                    <div class="card-body">
                        <!-- 商品情報 -->
                        <p><strong>価格:</strong> ￥{{ $item->price }}</p>
                        <p><strong>商品の状態:</strong> {{ $item->item_status }}</p>
                        <p><strong>商品の説明:</strong> {{ $item->item_description }}</p>

                        <!-- 「購入」ボタン -->
                        <button class="btn btn-success">購入</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
