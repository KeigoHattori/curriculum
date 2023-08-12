<!-- 売上履歴画面 -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>売上履歴</h1>
    @if($salesHistory->isEmpty())
        <p>まだ売上履歴がありません。</p>
    @else
        <?php
            $totalSales = $salesHistory->sum('price'); 
        ?>
        <p>合計売上金額: ¥{{ number_format($totalSales) }}</p>
        <table class="table">
            <thead>
                <tr>
                    <th>商品画像</th>
                    <th>商品名</th>
                    <th>価格</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
            @foreach($salesHistory as $item)
                @if ($item->isSold())
                    <tr>
                        <td><img src="{{ asset('storage/items/' . $item->item_image) }}" alt="商品画像" width="50"></td>
                        <td>{{ $item->item_name }}</td>
                        <td>¥{{ number_format($item->price) }}</td>
                        <td><a href="{{ route('item.details', $item->id) }}" class="btn btn-primary">詳細</a></td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
