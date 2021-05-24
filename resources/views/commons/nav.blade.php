@if (Auth::check())
    <ul class="navigation">
        @if (\Auth::id() === 1)
            <li>
                <a href="{{ route('admin') }}">管理者画面</a>
            </li>
        @else
            <li>
                <a href="{{ route('home') }}">マイページ</a>
            </li>
        @endif
        <li>
            <a href="" onclick="logout()">
                ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="post">
                @csrf
            </form>
            <script type="text/javascript">
                function logout() {
                    event.preventDefault();
                    if (window.confirm('ログアウトしますか？')) {
                        document.getElementById('logout-form').submit();
                    }
                }
            </script>
        </li>
    </ul>
@endif
