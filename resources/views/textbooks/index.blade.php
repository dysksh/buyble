@push('css')
    <link href="{{ asset('css/text-index.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>教科書一覧</h1>


<form action="{{ route('textbooks.index') }}">
   @csrf
   @method('get')
   <dl>
     <div class="idx-src">   
      <dt>ISBN番号</dt>
      <dd><input type="text" name="isbn_no" placeholder="ISBN番号" value="{{ request('isbn_no') }}"></dd>
      <dt>タイトル</dt>
      <dd><input type="text" name="title" placeholder="タイトル" value="{{ request('title') }}"></dd>
      <dt>分類</dt>   
      <dd>
         <select name="classification" id="">
            @if (!request('classification'))
               <option hidden></option>
            @endif
            @for ($i=0; $i < 11; $i++)
               <option value="{{ $i }}"<?= request('classification')===strval($i) ? 'selected': "" ?>>{{ $i }}</option>
            @endfor
         </select>
      </dd>
      <dt>著者名</dt>
      <dd><input type="text" name="author" placeholder="著者名" value="{{ request('author') }}"></dd>
      <dt>売値</dt>
      <dd><input type="number" name="price_min" placeholder="円" value="{{ request('price_min') }}">～<input type="number" name="price_max" placeholder="円" value="{{ request('price_max') }}"></dd>
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
     <th>ID</th>
     <th>タイトル</th>
     <th>著者名</th>
     <th>分類</th>
     <th>売値</th>
     <th>ISBN番号</th>
     <th>売り手ユーザID</th>
 </tr>
</thead>
</div>

<tbody>
  @foreach($textbooks as $textbook)
  <div class="txt-data">
  <tr>
     <td>{{ $textbook->id }}</td>
     <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</a></td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->classification }}</td>
     <td>{{ $textbook->price }}</td>
     <td>{{ $textbook->isbn_no }}</td>
     <td>{{ $textbook->seller_id }}</td>
  </tr> 
  </div>
  @endforeach
</tbody>
</table>
</div>
{{ $textbooks->links() }}
<div class="txt-reg">
 <p><a href="{{ route('textbooks.create') }}">+教科書登録</a></p>
</div>
@endsection