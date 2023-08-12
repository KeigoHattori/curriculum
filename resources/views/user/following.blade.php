@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $user->name }} のフォロー一覧</h2>
            <ul class="list-group">
                @foreach ($following as $followedUser)
                    <li class="list-group-item">
                        @if ($followedUser->user_icon)
                            <img src="{{ asset('storage/users/' . $followedUser->user_icon) }}" alt="ユーザーアイコン" width="50">
                        @endif
                        {{ $followedUser->name }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
