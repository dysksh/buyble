<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/nav.css">
    @stack('css')
</head>
<body>
    <header>
        <div class="container header">
            <a class="brand header-a"  href="/">
                <img src="/img/logo1.jpg" alt="ロゴ" width="25%" height="25%">{{ config('app.name') }}
            </a>
            @include('commons/nav')
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
