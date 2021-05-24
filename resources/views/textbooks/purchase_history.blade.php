<h1>購入履歴</h1>
<table class="table">
<thead>
  <tr>
     <th>タイトル</th>
     <th>著者名</th>
     <th>購入日時</th>
  </tr>
</thead>

<tbody>
  @foreach($textbooks as $textbook)
  <tr>
     <td>{{ $textbook->title }}</td>
     <td>{{ $textbook->author }}</td>
     <td>{{ $textbook->purchased_at }}</td>
  </tr> 
  @endforeach
  </tbody>
 </table> 