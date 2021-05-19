@extends('layouts.app')

@section('content')
<h1>会員登録</h1>
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
        <button type="submit">登録</button>
    </p>
    <p>または</p>
    <p>
        <a href="{{ route('login') }}">ログイン</a>
    </p>
</form>
@endsection