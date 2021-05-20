@extends('layouts.app')

@section('content')
<h1>マイページ</h1>
    <p><a href="{{ route('users.edit', $user) }}">会員登録情報変更</p>
    <p><a href="{{ route('home') }}">退会画面</p>
    <p><a href="{{ route('home') }}">登録履歴</p>
    <p><a href="{{ route('home') }}">購入履歴</p>
@endsection
