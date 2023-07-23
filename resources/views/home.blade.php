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

    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        @if ($items->count() > 0)
            @foreach ($items as $item)
                <a href="{{ route('item.details', $item->id) }}">
                    <img src="{{ asset('path/to/image.jpg') }}" alt="商品画像">
                </a>
            @endforeach
        @else
            <p class="text-center" style="font-size: 300%;">商品はありません。</p>
        @endif
    </div>
</div>
@endsection
