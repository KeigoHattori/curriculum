@extends('layouts.app')

@section('content')
    <h1>管理画面</h1>

    <form action="{{ route('admin.dashboard') }}" method="GET">
        <input type="text" name="search" placeholder="ユーザー検索" value="{{ request('search') }}">
        <button type="submit">検索</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ユーザー名</th>
                <th>アイコン</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a href="{{ route('admin.user.suspend', $user->id) }}">{{ $user->name }}</a></td>
                    <td>
                        @if ($user->user_icon)
                            <img src="{{ asset('storage/users/' . $user->user_icon) }}" alt="ユーザーアイコン" width="100">
                        @else
                            アイコン未設定
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
