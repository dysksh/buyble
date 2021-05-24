@push('css')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>buyble管理画面</h1>
    <p><a href="{{ route('textbooks.index') }}"><button class="btn-txt" type="submit">教科書一覧</button></a></p>
    <p><a href="{{ route('users.index') }}"><button class="btn-meb" type="submit">会員管理</button></a></p>
@endsection
