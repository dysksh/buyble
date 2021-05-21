<h1>教科書一覧</h1>

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
     <td>{{ $textbook->classification }}</td>
     <td>{{ $textbook->price }}</td>
     <td>{{ $textbook->isbn_no }}</td>
     <td>{{ $textbook->seller_id }}</td>
  </tr> 
  @endforeach
 </table> 