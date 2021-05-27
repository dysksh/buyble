@push('css')
    <link href="{{ asset('css/text-index.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
@include('commons/flash')

<h1>教科書一覧</h1>


<form action="{{ route('textbooks.index') }}">
   @csrf
   @method('get')
   <dl>
     <div class="idx-src">
      <dt>ISBN番号</dt>
      <dd><input type="text" min="0" name="isbn_no" placeholder="ISBN番号" value="{{ request('isbn_no') }}"></dd>
      <dt>タイトル</dt>
      <dd><textarea name="title" rows="3" cols="22" placeholder="タイトル">{{ request('title') }}</textarea></dd>
      <dt>カテゴリ</dt>
      <dd>
         <select name="classification_id" id="">
            @if (!request('classification_id'))
               <option hidden></option>
            @endif
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}"<?= request('classification_id')===strval($classification->id) ? 'selected': "" ?>>{{ $classification->name }}</option>
            @endforeach
         </select>
      </dd>
      <dt>著者名</dt>
      <dd><input type="text" name="author" placeholder="著者名" value="{{ request('author') }}"></dd>
      <dt>売値</dt>
      <dd><input type="number" min="50" name="price_min" placeholder="円" value="{{ request('price_min') }}">～<input type="number" min="50" name="price_max" placeholder="円" value="{{ request('price_max') }}"></dd>
    </div>
      <P class="serch">
         <button type="submit">検索</button>
      </p>
   </dl>
</form>

<div class="idx-tbl">
<table class="table">
<thead>
  <tr>
      <th>画像</th>
      @if (\Auth::id() === 1)
         <th>ID</th>
      @endif
      <th>タイトル</th>
      <th>著者名</th>
      <th>カテゴリ</th>
      <th>売値</th>
      <th>ISBN番号</th>
      @if (\Auth::id() === 1)
         <th>売り手ユーザID</th>
      @endif
    <th>在庫</th>
 </tr>
</thead>
</div>

<tbody>
  @foreach($textbooks as $textbook)
  <div class="txt-data">
  <tr>
      <td>
        @if ($textbook->file_name && $textbook->file_path)
        <img src="{{ $textbook->file_path.$textbook->file_name }}" width="64px" height="auto">
        @elseif ($textbook->file_name && !$textbook->file_path)
        <img src="{{ $textbook->file_name }}" width="64px" height="auto">
        @else
        <img src="../../img/noimage.jpg" width="64px" height="auto">
        @endif
      </td>
      @if (\Auth::id() === 1)
        <td>{{ $textbook->id }}</td>
      @endif
      <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</a></td>
      <td>{{ $textbook->author }}</td>
      <td>{{ $textbook->classification->name }}</td>
      <td>{{ $textbook->price }}</td>
      <td>{{ $textbook->isbn_no }}</td>
      @if (\Auth::id() === 1)
        <td>{{ $textbook->seller_id }}</td>
      @endif
      @if($textbook->purchased_at)
      <td>無</td>
      @else
      <td>有</td>
      @endif
  </tr>
  </div>
  @endforeach
</tbody>
</table>
</div>
{{ $textbooks->links() }}
@if (\Auth::id() !== 1)
   <div class="txt-reg">
      <p><a href="{{ route('textbooks.create') }}"><button class="create-textbook-btn">+教科書登録</button></a></p>
   </div>
@endif
@endsection
