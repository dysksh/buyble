@push('css')
    <link href="{{ asset('css/register-history.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')

<h1>登録履歴</h1>
<div class="idx-tbl">
<table class="table">
<thead>
  <tr>
     <th>画像</th>
     <th>タイトル</th>
     <th>著者名</th>
     <th>状態</th>
     <th>売値</th>
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
     <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</a></td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->condition->name }}</td>
     <td>{{ $textbook->price }}</td>
  </tr>
</div>
  @endforeach
  </tbody>
 </table>
 {{ $textbooks->links() }}

 @endsection
