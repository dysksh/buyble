@extends('layouts.app')

@section('content')
<h1>{{ $user->name }}詳細</h1>
@include('commons.flash')
    <dl>
        <dt>ID</dt>
        <dd>{{ $user->id }}</dd>

        <dt>名前</dt>
        <dd>{{ $user->name }}</dd>

        <dt>郵便番号</dt>
        <dd>{{ $user->postal }}</dd>

        <dt>住所</dt>
        <dd>{{ $user->address }}</dd>

        <dt>電話番号</dt>
        <dd>{{ $user->phone }}</dd>

        <dt>メールアドレス</dt>
        <dd>{{ $user->email }}</dd>

        <dt>登録日時</dt>
        <dd>{{ $user->created_at }}</dd>
    </dl>

    <a href="{{ route('users.show', $user->id) }}">編集</a>

    <a href="" onclick="deleteUser()">削除</a>
    <form action="{{ route('users.admindestroy', $user->id) }}" method="POST"  id="delete-form">
        @csrf
        @method('put')
    </form>
    <script type="text/javascript">
        function deleteUser(){
            event.preventDefault();
            if (window.confirm('すべての会員情報が削除されます。よろしいですか？')){
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
