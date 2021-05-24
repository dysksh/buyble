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
  <dd><input type="text" name="price" value="{{ $textbook->price }}"></dd>    
</dl>
<button type="submit">更新</button>
</form>
@endsection