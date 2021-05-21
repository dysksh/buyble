@push('css')
    <link href="{{ asset('css/mypage.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>マイページ</h1>
  <div>
    <p><a href="{{ route('users.edit') }}"><button class="button" type="button">会員登録情報変更</button></p>
    <p><a href="{{ route('users.delete') }}"><button class="button" type="button">退会画面</button></p>
    <p><a href="{{ route('home') }}"><button class="button" type="button">登録履歴</button></p>
    <p><a href="{{ route('home') }}"><button class="button" type="button">購入履歴</button></p>
  </div>  
@endsection
