<h1>登録履歴</h1>
<table class="table">
<thead>
  <tr>
     <th>タイトル</th>
     <th>著者名</th>
     <th>状態</th>
     <th>売値</th>
  </tr>
</thead>

<tbody>
  @foreach($textbooks as $textbook)
  <tr>
     <td>{{ $textbook->title }}</td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->condition }}</td>
     <td>{{ $textbook->price }}</td>
  </tr> 
  @endforeach
  </tbody>
 </table> 