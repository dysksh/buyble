@push('css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<div>
<p class="logo1"><img src="/img/ロゴ１/ロゴ1.jpg" alt="ロゴ"></p>
<h1 class="login-text">{{ config('app.name') }}ログイン</h1>
@include('commons/flash')
<form action="{{ route('login') }}" method="post">
    @csrf
    <p>
        <label for="">メールアドレス</label><br>
        <input type="email" name="email" value="{{ old('email') }}">
    </p>
    <p>
        <label for="">パスワード</label><br>
        <input type="password" name="password" value="">
    </p>
    <p></p>
    <p><a href="" class="btn btn--red btn--radius btn--cubic">ログイン<i class="fas fa-angle-right fa-position-right"></i></a></p>
    <p>または</p>
    <p>
        <a href="{{ route('register') }}">会員登録</a>   
    </p>
</form>
</div>
@endsection