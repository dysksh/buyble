@push('css')
    <link href="{{ asset('css/create.css') }}" rel="stylesheet">
@endpush
@extends('layouts.app')

@section('content')
<h1>教科書登録画面</h1>
<div class="search-area">
    <form action="{{ route('textbooks.create') }}" method="get">
        ISBN番号:<input type="text" name="keyword" size="25" value="{{ $keyword }}">&nbsp;<input type="submit" value="検索">
    </form>
</div>

@if ($items == null)
            <p>ISBN番号を入力してください。</p>
        @else (count($items) > 0)
            <p>「{{ $keyword }}」の検索結果</p>
            <div class="search-result">
            @foreach ($items as $item)
            <h2>{{ $item['volumeInfo']['title']}}</h2>
                @if (array_key_exists('imageLinks', $item['volumeInfo']))
                    <img src="{{ $item['volumeInfo']['imageLinks']['thumbnail']}}"><br>
                @endif
                                
                @if (array_key_exists('description', $item['volumeInfo']))
                    著者：{{ $item['volumeInfo']['authors'][0]}}<br>
                @endif
                @if (array_key_exists('description', $item['volumeInfo']))
                    発売年月：{{ $item['volumeInfo']['publishedDate']}}<br>
                @endif
                <br>
                @foreach ($item['volumeInfo']['industryIdentifiers'] as $industryIdentifier)
                    {{ $industryIdentifier['type'] }}&nbsp;：&nbsp;{{ $industryIdentifier['identifier'] }} <br>
                @endforeach
                <br>
                @if (array_key_exists('description', $item['volumeInfo']))
                    概要：{{ $item['volumeInfo']['description']}}<br>
                @endif
                <br>
                @if (array_key_exists('imageLinks', $item['volumeInfo']) && array_key_exists('description', $item['volumeInfo']) && $item['volumeInfo']['industryIdentifiers'])
                <button id="application">適用</button>
                <script>
                    let application = document.querySelector('#application');
                    function updateForm() {
                        let isbnNo = document.querySelector('#isbn_no');
                        let title = document.querySelector('#title');
                        let author = document.querySelector('#author');
                        let isbnNoVal = <?php echo json_encode($item['volumeInfo']['industryIdentifiers'][0]['identifier']); ?>;
                        let titleVal = <?php echo json_encode($item['volumeInfo']['title']); ?>;
                        let authorVal = <?php echo json_encode($item['volumeInfo']['authors'][0]); ?>;
                        isbnNo.value = isbnNoVal.toLocaleString();
                        title.value = titleVal.toLocaleString();
                        author.value = authorVal.toLocaleString();
                        let googleImage = document.querySelector('#google_image');
                        let googleImageVal = <?php echo json_encode($item['volumeInfo']['imageLinks']['thumbnail']); ?>;
                        googleImage.value = googleImageVal.toLocaleString();

                        let img = document.getElementById('preview');
                        img.setAttribute('src', googleImageVal);
                    }
                    application.addEventListener("click", function() {updateForm()});
                </script>
                @endif
                </div>
            @endforeach
        @endif

<div>
<form action="{{ route('textbooks.store') }}" method="post" enctype="multipart/form-data">
@csrf
<dl>
   <dt>ISBN番号</dt>
   <dd>
       <input type="text" name="isbn_no" id="isbn_no" value="{{ old('isbn_no', $textbook->isbn_no) }}">
   </dd>
   <dt>タイトル</dt>
   <dd>
       <input type="text" name="title" id="title" value="{{ old('title', $textbook->title) }}">
   </dd>
   <dt>著者名</dt>
   <dd>
       <input type="text" name="author" id="author" value="{{ old('author', $textbook->author) }}">
   </dd>
   <dt>カテゴリ</dt>
   <dd>
        <select name="classification_id" id="">
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}"<?= request('classification_id')===strval($classification->id) ? 'selected': "" ?>>{{ $classification->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>状態</dt>
   <dd>
        <select name="condition_id" id="">
            @foreach ($conditions as $condition)
                <option value="{{ $condition->id }}"<?= request('condition_id')===strval($condition->id) ? 'selected': "" ?>>{{ $condition->name }}</option>
            @endforeach
        </select>
   </dd>
   <dt>売値</dt>
   <dd>
       <input type="number" min="1" name="price" value="{{ old('price', $textbook->price) }}">
   </dd>
   <dt>画像</dt>
   <dd>
        <img id="preview" width="200px" style="display: block; margin: 10px auto;">
        <input type="file" name="image" accept="image/png, image/jpeg" />
   </dd>
</dl>
<input type="hidden" name="google_image" id="google_image">
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
