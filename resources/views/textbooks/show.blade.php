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
              <dt>カテゴリ</dt>
              <dd>{{ $textbook->classification->name }}</dd>
              <dt>状態</dt>
              <dd>{{ $textbook->condition->name }}</dd>
              <dt>売値</dt>
              <dd>{{ $textbook->price }}</dd> 
              <dt>画像</dt>
              @if ($textbook->file_name && $textbook->file_path)
                <img src="{{ $textbook->file_path.$textbook->file_name }}" width="200px" height="auto">
              @elseif ($textbook->file_name && !$textbook->file_path)
                <img src="{{ $textbook->file_name }}" width="200px" height="auto">
              @else
                <img src="../../img/noimage.jpg" width="200px" height="auto">
              @endif
              @if($textbook->purchased_at)
               <dd>在庫なし</dd>
              @else
               <dd>在庫あり</dd>
              @endif
            </dl>          

            @if (\Auth::id()!==$textbook->seller_id && \Auth::id()!==1 && !$textbook->purchased_at)
              <form action="{{ route('purchase', $textbook->id) }}" method="post" class="purchase-form">
                  @csrf 
                  @method('put')
                  <script
                      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                      data-key="{{ env('STRIPE_KEY') }}"
                      data-amount=<?php echo json_encode($textbook->price); ?>
                      data-name="クレジットカード決済"
                      data-label="購入"
                      data-locale="auto"
                      data-currency="JPY">
                  </script>
              </form>
            @endif
            @if (\Auth::id()===1 || \Auth::id()===$textbook->seller_id)
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
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection