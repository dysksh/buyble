@push('css')
    <link href="{{ asset('css/purchase-history.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>購入履歴</h1>
<div class="idx-tbl">
<table class="table">
<thead>
  <tr>
     <th>タイトル</th>
     <th>著者名</th>
     <th>購入日時</th>
  </tr>
</thead>
</div>
<tbody>
  @foreach($textbooks as $textbook)
  <div class="txt-data">
  <tr>
     <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</a></td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->purchased_at }}</td>
  </tr> 
</div>
  @endforeach
  </tbody>
 </table> 
 {{ $textbooks->links() }}
 
 @endsection