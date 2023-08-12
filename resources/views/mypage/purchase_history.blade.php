<!--購入履歴画面-->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">購入履歴</div>
                <div class="card-body">
                    @if ($purchaseHistory->count() > 0)
                        <p>合計購入金額: ¥{{ number_format($purchaseHistory->sum('item.price')) }}</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>商品画像</th>
                                    <th>商品名</th>
                                    <th>価格</th>
                                    <th>売買日時</th>
                                    <th>詳細</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchaseHistory as $historyItem)
                                    <tr>
                                        <td><img src="{{ asset('storage/items/' . $historyItem->item->item_image) }}" alt="商品画像" width="50"></td>
                                        <td>{{ $historyItem->item->item_name }}</td>
                                        <td>¥{{ number_format($historyItem->item->price) }}</td>
                                        <td>{{ $historyItem->purchase_date }}</td>
                                        <td><a href="{{ route('item.details', $historyItem->item->id) }}" class="btn btn-primary">詳細</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>まだ購入履歴がありません。</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
