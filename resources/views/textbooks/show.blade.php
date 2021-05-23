@extends('layouts.app')
@section('content')
<h1>書籍情報</h1>
<dl>
  <dt>ISBN番号</dt>
  <dd>{{ $textbook->isbn_no }}</dd>
  <dt>タイトル</dt>
  <dd>{{ $textbook->title }}</dd>
  <dt>著者名</dt>
  <dd>{{ $textbook->author }}</dd>
  <dt>分類</dt>
  <dd>{{ $textbook->classification->name }}</dd>
  <dt>状態</dt>
  <dd>{{ $textbook->condition->name }}</dd>
  <dt>売値</dt>
  <dd>{{ $textbook->price }}</dd>    
</dl>
<a href="">購入</a>
<a href="">編集</a>
<a href="">削除</a>
@endsection