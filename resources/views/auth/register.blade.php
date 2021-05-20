@push('css')
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<div>
<p class="logo1"><img src="/img/logo1.jpg" alt="ロゴ"></p>
<h1>{{ config('app.name') }}会員登録</h1>
@include('commons/flash')
<form action="{{ route('register') }}" method="post">
    @csrf
    <p>
        <label for="">お名前</label><br>
        <input type="text" name="name" value="{{ old('name') }}">
    </p>
    <p>
        <label for="">郵便番号</label><br>
        <input type="number" name="postal" value="{{ old('postal') }}">
    </p>
    <p>
        <label for="">住所</label><br>
        <input type="text" name="address" value="{{ old('address') }}">
    </p>
    <p>
        <label for="">電話番号</label><br>
        <input type="number" name="phone" value="{{ old('phone') }}">
    </p>
    <p>
        <label for="">メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </p>
    <p>
        <label for="">パスワード</label><br>
        <input type="password" name="password" value="">
    </p>
    <p>
        <label for="">パスワード確認</label><br>
        <input type="password" name="password_confirmation" value="">
    </p>
    <p>
    <p id=""><a href="" class="btn btn--red btn--radius btn--cubic">登録<i class="fas fa-angle-right fa-position-right"></i></a></p>
    </p>
    <p>または</p>
    <p>
        <a href="{{ route('login') }}">ログイン</a>
    </p>
</form>
</div>
@endsection