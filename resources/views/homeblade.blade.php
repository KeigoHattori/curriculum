@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('search') }}" method="get" class="mb-3">
        <div class="row">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control" placeholder="検索したい商品の情報で絞り込む">
            </div>
            <div class="col-md-3">
                <select name="price" class="form-control">
                    <option value="">価格で絞り込む</option>
                    <option value="1000">1000以下</option>
                    <option value="5000">5000以下</option>
                    <option value="10000">10000以下</option>
                    <option value="50000">50000以下</option>
                    <option value="100000">100000以下</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>

    <div class="row">
    @if ($items->count() > 0)
    @foreach ($items as $item)
        <div class="col-md-3 mb-4">
            <div class="card " style="height: 100%;">
                <img src="{{ asset('storage/items/' . $item->item_image) }}" alt="商品画像" style="height: 200px;"> 
                <div class="card-body">
                    <h5 class="card-title">{{ $item->item_name }}</h5>
                    <p class="card-text">価格: ¥{{ number_format($item->price) }}</p>
                    @if ($item->isSold())
                    <p class="card-text"><strong class="text-danger">SOLD OUT</strong></p>
                    @endif
                    <a href="{{ route('item.details', $item->id) }}" class="btn btn-primary">詳細を見る</a>
                </div>
            </div>
        </div>
    @endforeach
    @else
        <div class="col-md-12">
            <p class="text-center" style="font-size: 300%;">商品はありません。</p>
        </div>
    @endif
</div>

@endsection
