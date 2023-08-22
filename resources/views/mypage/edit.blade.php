<!-- resources/views/mypage/edit.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">プロフィール編集</div>
        <div class="card-body">
        <form action="{{ route('mypage.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <!-- ユーザーアイコンの編集フォーム -->
                <div class="form-group">
                    <label for="user_icon">ユーザーアイコン</label>
                    <input type="file" name="user_icon" id="user_icon" accept="image/*">
                </div>

                <!-- ユーザー名の編集フォーム -->
                <div class="form-group">
                    <label for="name">ユーザー名</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>

                <!-- 自己紹介文の編集フォーム -->
                <div class="form-group">
                    <label for="self_introduction">自己紹介文</label>
                    <textarea class="form-control" id="self_introduction" name="self_introduction" rows="4">{{ $user->self_introduction }}</textarea>
                </div>

                <!-- メールアドレスの編集フォーム -->
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>

                <!-- 氏名の編集フォーム -->
                <div class="form-group">
                    <label for="full_name">氏名</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $user->full_name }}">
                </div>

                <!-- 電話番号の編集フォーム -->
                <div class="form-group">
                    <label for="phone_number">電話番号</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                </div>

                <!-- 郵便番号の編集フォーム -->
                <div class="form-group">
                    <label for="postal_code">郵便番号</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $user->postal_code }}">
                </div>

                <!-- 住所の編集フォーム -->
                <div class="form-group">
                    <label for="address">住所</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
            </form>
        </div>
    </div>
@endsection
