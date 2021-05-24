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
     <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</td>
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