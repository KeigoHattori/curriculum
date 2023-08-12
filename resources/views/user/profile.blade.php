@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>出品者プロフィール</h2>
            <div class="row">
                <div class="col-md-4">
                    <p>ユーザー名: {{ $user->name }}</p>
                    @if ($user->self_introduction)
                        <h3>プロフィール</h3>
                        <p>{{ $user->self_introduction }}</p>
                    @endif
                </div>
                <div class="col-md-4">
                    @if ($user->user_icon)
                        <img src="{{ asset('storage/users/' . $user->user_icon) }}" alt="ユーザーアイコン" width="162">
                    @else
                        <p>アイコンが未設定です</p>
                    @endif
                </div>
                @if (Auth::check() && Auth::user()->id !== $user->id)
                    @if (Auth::user()->following->contains($user->id))
                        <form action="{{ route('user.unfollow', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">フォロー解除</button>
                        </form>
                    @else
                        <form action="{{ route('user.follow', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">フォローする</button>
                        </form>
                    @endif
                @endif
            </div>

            <h3>出品一覧</h3>
            <div class="row justify-content-left">
                @foreach ($user->items as $item)
                    <div class="col-md-3 mb-2">
                        <div class="card" style="height: 100%;">
                            <img src="{{ asset('storage/items/' . $item->item_image) }}" alt="商品画像" style="height: 250px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->item_name }}</h5>
                                <p class="card-text">価格: ¥{{ number_format($item->price) }}</p>
                                @if ($item->isSold())
                                    <p class="text-danger">SOLD OUT</p>
                                @else
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
