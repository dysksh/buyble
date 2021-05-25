@push('css')
    <link href="{{ asset('css/user.show.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')
@include('commons.flash')
@section('content')
<h1>{{ $user->name }}詳細</h1>
<div class="container m-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">会員詳細情報</div>
          <div class="card-body">
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

    @if (\Auth::id() === 1 && $user->id !== 1)
        <a href="{{ route('users.adedit', $user->id) }}"><button class="btn-user" type="submit">編集</button></a>
    @endif

    @if (\Auth::id() === 1 && $user->id !== 1)
        <a href="" onclick="deleteUser()"><button type="submit">削除</button></a>
        <form action="{{ route('users.admindestroy', $user->id) }}" method="POST"  id="delete-form">
            @csrf
            @method('delete')
        </form>
        <script type="text/javascript">
            function deleteUser(){
                event.preventDefault();
                if (window.confirm('すべての会員情報が削除されます。よろしいですか？')){
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
    @endif
    
          </div>
        </div>
      </div>
    </div>
  </div>
</div>    
@endsection
