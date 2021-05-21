@extends('layouts.app')

@section('content')
<h1>会員管理</h1>
<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id}}</td>
                <td>
                    <a href="{{ route('users.index') }}">
                        {{ $user->name }}
                    </a>
                </td>
                <td>{{ $user->email }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection