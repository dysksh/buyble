@push('css')
    <link href="{{ asset('css/text-index.css') }}" rel="stylesheet">
@endpush

@extends('layouts.app')

@section('content')
<h1>会員管理</h1>

<form action="{{ route('users.index') }}">
    @csrf
    @method('get')
    <dl>
        <div class="idx-src">
            <dt>ユーザID</dt>
                <dd><input type="number" min="0" name="id" placeholder="ユーザID" value="{{ request('id') }}"></dd>
            <dt>名前</dt>
                <dd><input type="text" name="name" placeholder="名前" value="{{ request('name') }}"></dd>
            <dt>メールアドレス</dt>
                <dd><input type="text" name="email" placeholder="メールアドレス" value="{{ request('email') }}"></dd>
        </div>
        <P class="serch">
            <button type="submit">検索</button>
        </p>
    </dl>
 </form>

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
                    <a href="{{ route('users.show', $user->id) }}">
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
