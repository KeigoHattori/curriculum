@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">商品購入</div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('item.purchase.submit', $item->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="full_name">氏名</label>
                            <input id="full_name" type="text" class="form-control" name="full_name" required
                                value="{{ old('full_name', $user->full_name) }}">
                        </div>

                        <div class="form-group">
                            <label for="phone_number">電話番号</label>
                            <input id="phone_number" type="text" class="form-control" name="phone_number" required
                                value="{{ old('phone_number', $user->phone_number) }}">
                        </div>

                        <div class="form-group">
                            <label for="postal_code">郵便番号</label>
                            <input id="postal_code" type="text" class="form-control" name="postal_code" required
                                value="{{ old('postal_code', $user->postal_code) }}">
                        </div>

                        <div class="form-group">
                            <label for="address">住所</label>
                            <textarea id="address" class="form-control" name="address" rows="3" required>{{ old('address', $user->address) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">購入する</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection