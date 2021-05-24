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
        <select name="classification_id" id="">
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}"<?= request('classification_id')===strval($classification->id) ? 'selected': "" ?>>{{ $classification->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>状態</dt>
   <dd>
        <select name="condition_id" id="">
            @foreach ($conditions as $condition)
                <option value="{{ $condition->id }}"<?= request('condition_id')===strval($condition->id) ? 'selected': "" ?>>{{ $condition->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>売値</dt>
   <dd>
       <input type="text" name="price" value="{{ old('price', $textbook->price) }}">
   </dd>
</dl>

<button type="submit">登録</button>
</form>
@endsection
