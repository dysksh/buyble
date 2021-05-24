@extends('layouts.app')

@section('content')
<h1>教科書編集</h1>

<form action="{{ route('textbooks.update', $textbook->id) }}" method="post">
@csrf
@method('put')
<dl>
  <dt>ISBN番号</dt>
  <dd><input type="text" name="isbn_no" value="{{ $textbook->isbn_no }}"></dd>
  <dt>タイトル</dt>
  <dd><input type="text" name="title" value="{{ $textbook->title }}"></dd>
  <dt>著者名</dt>
  <dd><input type="text" name="author" value="{{ $textbook->author }}"></dd>
  <dt>分類</dt>
  <dd><input type="text" name="classification" value="{{ $textbook->classification }}"></dd>
  <dt>状態</dt>
  <dd><input type="text" name="condition" value="{{ $textbook->condition }}"></dd>
  <dt>売値</dt>
  <dd><input type="text" name="price" value="{{ $textbook->price }}"></dd>    
</dl>
<button type="submit">更新</button>
</form>
@endsection