@extends('layouts.app')

@section('content')
<div class="container m-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">会員登録情報変更画面</div>
                    <div class="card-body">
                        @include('commons.flash')
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">
                                名前
                                </label>
                                <div>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="postal">
                                郵便番号
                                </label>
                                <div>
                                <input type="text" name="postal" class="form-control" value="{{ $user->postal }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address">
                                住所
                                </label>
                                <div>
                                    <textarea name="address" rows="2" class="form-control">{{ $user->address }}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="phone">
                                電話番号
                                </label>
                                <div>
                                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">
                                    メールアドレス
                                </label>
                                <div>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>

                            <button type="submit" class="user-btn">更新</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
