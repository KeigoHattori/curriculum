@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品編集</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('item.update', $item->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="item_name" class="col-md-4 col-form-label text-md-right">商品名</label>
                            <div class="col-md-6">
                                <input id="item_name" type="text" class="form-control @error('item_name') is-invalid @enderror" name="item_name" value="{{ old('item_name', $item->item_name) }}" required autocomplete="item_name" autofocus>
                                @error('item_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">価格</label>
                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', floor($item->price)) }}" required autocomplete="price" autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="item_status" class="col-md-4 col-form-label text-md-right">商品の状態</label>
                            <div class="col-md-6">
                                <select name="item_status" id="item_status" class="form-control @error('item_status') is-invalid @enderror" required>
                                    <option value="">選択してください</option>
                                    <option value="新品、未使用" {{ old('item_status', $item->item_status) === '新品、未使用' ? 'selected' : '' }}>新品、未使用</option>
                                    <option value="未使用に近い" {{ old('item_status', $item->item_status) === '未使用に近い' ? 'selected' : '' }}>未使用に近い</option>
                                    <option value="目立った傷や汚れなし" {{ old('item_status', $item->item_status) === '目立った傷や汚れなし' ? 'selected' : '' }}>目立った傷や汚れなし</option>
                                    <option value="やや傷や汚れあり" {{ old('item_status', $item->item_status) === 'やや傷や汚れあり' ? 'selected' : '' }}>やや傷や汚れあり</option>
                                    <option value="傷や汚れあり" {{ old('item_status', $item->item_status) === '傷や汚れあり' ? 'selected' : '' }}>傷や汚れあり</option>
                                    <option value="全体的に状態が悪い" {{ old('item_status', $item->item_status) === '全体的に状態が悪い' ? 'selected' : '' }}>全体的に状態が悪い</option>
                                </select>
                                @error('item_status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="item_description" class="col-md-4 col-form-label text-md-right">商品説明</label>
                            <div class="col-md-6">
                                <textarea id="item_description" class="form-control @error('item_description') is-invalid @enderror" name="item_description" rows="4">{{ old('item_description', $item->item_description) }}</textarea>
                                @error('item_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="item_image" class="col-md-4 col-form-label text-md-right">商品画像</label>
                            <div class="col-md-6">
                                <input id="item_image" type="file" class="form-control-file @error('item_image') is-invalid @enderror" name="item_image">
                                @error('item_image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    更新
                                </button>
                            </div>
                        </div>
                    </form>
                        <form method="POST" action="{{ route('item.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-danger">
                                        削除
                                    </button>
                                </div>
                            </div>
                        </form>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
