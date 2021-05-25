@push('css')
    <link href="{{ asset('css/user-delete.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
    <h1>退会画面</h1>
    @include('commons.flash')
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

    @if (\Auth::id() !== 1)
        <a href="" onclick="deleteUser()"><button class="btn-del" type="submit">退会する</button></a>
        <form action="{{ route('users.destroy', $user) }}" method="POST"  id="delete-form">
            @csrf
            @method('delete')
        </form>
        <script type="text/javascript">
            function deleteUser(){
                event.preventDefault();
                if (window.confirm('退会するとすべての会員情報が削除されます。よろしいですか？')){
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
