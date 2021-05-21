@extends('layouts.app')

@section('content')
<h1>教科書登録画面</h1>

<form action="{{ route('textbooks.store') }}" method="post">
@csrf 
<dl>
   <dt>ISBN番号</dt>
   <dd>
       <input type="text" name="isbn_no" value="{{ old('isbn_no', $textbook->isbn_no) }}">
   </dd>
   <dt>タイトル</dt>
   <dd>
       <input type="text" name="title" value="{{ old('title', $textbook->title) }}">
   </dd>
   <dt>著者名</dt>
   <dd>
       <input type="text" name="author" value="{{ old('author', $textbook->author) }}">
   </dd>
   <dt>分類</dt>
   <dd>
       <input type="text" name="classification" 
              value="{{ old('classification', $textbook->classification) }}">
   </dd>
   <dt>状態</dt>
   <dd>
       <input type="text" name="condition" 
              value="{{ old('condition', $textbook->condition) }}">
   </dd>
   <dt>売値</dt>
   <dd>
       <input type="text" name="price" value="{{ old('price', $textbook->price) }}">
   </dd>
</dl>

<button type="submit">登録</button>
</form>
@endsection
