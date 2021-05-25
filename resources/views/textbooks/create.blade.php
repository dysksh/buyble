@push('css')
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>教科書登録画面</h1>


<div>
<form action="{{ route('textbooks.store') }}" method="post" enctype="multipart/form-data">
@csrf
<dl>
   <dt>ISBN番号</dt>
   <dd>
       <input type="text" name="isbn_no" value="{{ old('isbn_no', $textbook->isbn_no) }}" required>
   </dd>
   <dt>タイトル</dt>
   <dd>
       <input type="text" name="title" value="{{ old('title', $textbook->title) }}" required>
   </dd>
   <dt>著者名</dt>
   <dd>
       <input type="text" name="author" value="{{ old('author', $textbook->author) }}" required>
   </dd>
   <dt>分類</dt>
   <dd>
        <select name="classification_id" id="" required>
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}"<?= request('classification_id')===strval($classification->id) ? 'selected': "" ?>>{{ $classification->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>状態</dt>
   <dd>
        <select name="condition_id" id="" required>
            @foreach ($conditions as $condition)
                <option value="{{ $condition->id }}"<?= request('condition_id')===strval($condition->id) ? 'selected': "" ?>>{{ $condition->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>売値</dt>
   <dd>
       <input type="number" name="price" value="{{ old('price', $textbook->price) }}" required>
   </dd>
   <dt>画像</dt>
   <dd>
        <img id="preview" width="200px" style="display: block; margin-bottom: 10px;">
        <input type="file" name="image" accept="image/png, image/jpeg" />
   </dd>
</dl>

<p><button type="submit" class="create-btn">登録</button></p>
</form>
<script>
    window.addEventListener('DOMContentLoaded',function(){
    $("[name='image']").on('change', function (e) {
        
        var reader = new FileReader();
        
        reader.onload = function (e) {
            $("#preview").attr('src', e.target.result);
        }
    
        reader.readAsDataURL(e.target.files[0]);   
    
    });
    });
</script>
</div>
@endsection
