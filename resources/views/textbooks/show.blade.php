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
  @if($textbook->purchased_at)
     <dd>在庫なし</dd>
     @else
     <dd>在庫あり</dd>
     @endif   
</dl>
@if (\Auth::id()!==$textbook->seller_id && \Auth::id()!==1 && !$textbook->purchased_at)
  <form action="{{ route('purchase', $textbook->id) }}" method="post">
    @csrf 
    @method('put')
    <button type="submit">購入</button>
  </form>
@endif
<a href="{{ route('textbooks.edit', $textbook->id) }}">編集</a>
<a href="" onclick="deleteTextbook()">削除</a>
    <form action="{{ route('textbooks.destroy', $textbook) }}" method="POST"  id="delete-form">
        @csrf
        @method('delete')
    </form>
    <script type="text/javascript">
        function deleteTextbook(){
            event.preventDefault();
            if (window.confirm('教科書情報が削除されます。よろしいですか？')){
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection