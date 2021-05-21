@extends('layouts.app')

@section('content')
<h1>buyble管理画面</h1>
    <p><a href="{{ route('textbooks.index') }}">教科書一覧</a></p>
    <p><a href="{{ route('users.index') }}">会員管理</a></p>
@endsection
