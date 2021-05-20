<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>buyble</title>

</head>
<body>
<h1>buyble管理画面</h1>
<ul style="list-style: none; padding-left: 0;"> 
<li style="text-align:center"><input type="button" onclick="" value="教科書一覧"></li>
<li style="text-align:center"><input type="button" onclick="" value="会員管理"></li>

<li style="text-align:center">
    <form action="{{ route('logout') }}" name="logout" method="post">
      <input type="submit" value="ログアウト">
    </form>
</li>
</ul>



    
</body>
</html>

