@push('css')
    <link href="{{ asset('css/show.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')
@section('content')
<h1>書籍情報</h1>
<div class="container m-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">教科書詳細情報</div>
          <div class="card-body">
            <dl>
              <dt>ISBN番号</dt>
              <dd>{{ $textbook->isbn_no }}</dd>
              <dt>タイトル</dt>
              <dd>{{ $textbook->title }}</dd>
              <dt>著者名</dt>
              <dd>{{ $textbook->author }}</dd>
              <dt>分類</dt>
              <dd>{{ $textbook->classification->name }}</dd>
              <dt>状態</dt>
              <dd>{{ $textbook->condition->name }}</dd>
              <dt>売値</dt>
              <dd>{{ $textbook->price }}</dd>    
            </dl>          

            @if (\Auth::id()!==$textbook->seller_id && \Auth::id()!==1 && !$textbook->purchased_at)
              <form action="{{ route('purchase', $textbook->id) }}" method="post" class="purchase-form">
                @csrf 
                @method('put')
                <button type="submit">購入</button>
              </form>
            @endif
            <a href="{{ route('textbooks.edit', $textbook->id) }}"><button class="btn-edit" type="submit">編集</button></a>
            <a href="" onclick="deleteTextbook()"><button class="btn-det" type="submit">削除</button></a>
            <form action="{{ route('textbooks.destroy', $textbook) }}" method="POST"  id="delete-form">
              @csrf
              @method('delete')
            </form>
            <script type="text/javascript">
              function deleteTextbook(){
              event.preventDefault();
              if (window.confirm('教科書情報が削除されます。よろしいですか？')){
              document.getElementById('delete-form').submit();
                      }
                  }
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection