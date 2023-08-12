@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $user->name }} がいいねした出品一覧</h2>
            <ul class="list-group">
                @foreach ($likedItems as $item)
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-2">
                                @if ($item->item_image)
                                    <img src="{{ asset('storage/items/' . $item->item_image) }}" alt="商品画像" width="100">
                                @else
                                    <p>画像なし</p>
                                @endif
                            </div>
                            <div class="col-8">
                                <h4>{{ $item->item_name }}</h4>
                                <p>価格: ¥{{ number_format($item->price) }}</p>
                                <a href="{{ route('item.details', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
