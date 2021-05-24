<h1>教科書一覧</h1>


<form action="{{ route('textbooks.index') }}">
   @csrf
   @method('get')
   <dl>
      <dt>ISBN番号</dt>
      <dd><input type="text" name="isbn_no" placeholder="ISBN番号" value="{{ request('isbn_no') }}"></dd>
      <dt>タイトル</dt>
      <dd><input type="text" name="title" placeholder="タイトル" value="{{ request('title') }}"></dd>
      <dt>分類</dt>
      <dd>
         <select name="classification_id" id="">
            @if (!request('classification_id'))
               <option hidden></option>
            @endif
            @foreach ($classifications as $classification)
                <option value="{{ $classification->id }}"<?= request('classification_id')===strval($classification->id) ? 'selected': "" ?>>{{ $classification->name }}</option>
            @endforeach
         </select>
      </dd>
      <dt>著者名</dt>
      <dd><input type="text" name="author" placeholder="著者名" value="{{ request('author') }}"></dd>
      <dt>売値</dt>
      <dd><input type="number" name="price_min" placeholder="円" value="{{ request('price_min') }}">～<input type="number" name="price_max" placeholder="円" value="{{ request('price_max') }}"></dd>
      <button type="submit">検索</button>
   </dl>
</form>

<table class="table">
<thead>
  <tr>
     <th>ID</th>
     <th>タイトル</th>
     <th>著者名</th>
     <th>分類</th>
     <th>売値</th>
     <th>ISBN番号</th>
     <th>売り手ユーザID</th>
 </tr>
</thead>

<tbody>
  @foreach($textbooks as $textbook)
  <tr>
     <td>{{ $textbook->id }}</td>
     <td><a href="{{ route('textbooks.show', $textbook) }}">{{ $textbook->title }}</a></td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->classification->name }}</td>
     <td>{{ $textbook->price }}</td>
     <td>{{ $textbook->isbn_no }}</td>
     <td>{{ $textbook->seller_id }}</td>
  </tr> 
  @endforeach
</tbody>
</table>
{{ $textbooks->links() }}
 <p><a href="{{ route('textbooks.create') }}">+教科書登録</a></p>
