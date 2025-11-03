<nav style="padding:12px;background:#111827;color:white">
<a href="{{ url('/') }}" style="color:#fff">Trang chủ</a>
<a href="{{ route('articles.index') }}" style="color:#fff">Bài viết</a>
@auth
<a href="{{ route('articles.create') }}" style="color:#fff">Viết bài</a>
<form method="POST" action="{{ route('logout') }}"
style="display:inline">
@csrf
<button type="submit"
style="background:none;border:none;color:#fff;cursor:pointer">Đăng
xuất</button>
</form>
@endauth

@guest
<a href="{{ route('login') }}" style="color:#fff">Đăng nhập</a>
<a href="{{ route('register') }}" style="color:#fff">Đăng ký</a>
@endguest
</nav>