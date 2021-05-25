@push('css')
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<div>
<p class="logo1"><img src="/img/logo2.png" alt="ロゴ"></p>
<h1>{{ config('app.name') }}会員登録</h1>
@include('commons/flash')
<form action="{{ route('register') }}" method="post">
    @csrf
    <p>
        <label for="">お名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </p>
    <p>
        <label for="">郵便番号</label><br>
        <input type="number" min="0" name="postal" value="{{ old('postal') }}" required>
    </p>
    <p>
        <label for="">住所</label><br>
        <input type="text" name="address" value="{{ old('address') }}" required>
    </p>
    <p>
        <label for="">電話番号</label><br>
        <input type="number" min="0" name="phone" value="{{ old('phone') }}" required>
    </p>
    <p>
        <label for="">メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </p>
    <p>
        <label for="">パスワード</label><br>
        <input type="password" name="password" value="" required>
    </p>
    <p>
        <label for="">パスワード確認</label><br>
        <input type="password" name="password_confirmation" value="" required>
    </p>
    <p>
        <button class="reg-btn" type="submit">登録</button>
    </p>
    <p>または</p>
    <p>
        <a href="{{ route('login') }}">ログイン</a>
    </p>
</form>
</div>
@endsection
