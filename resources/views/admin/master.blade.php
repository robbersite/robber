<!DOCTYPE html>
<html>
<head>
	<title>极盗者</title>
	<link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
	<link href="/css/home.css" rel="stylesheet">
</head>
<body>
	<div class="header">
		<div class="header-brand">
			<a href="{{ url('/admin/users') }}">极盗者</a>
		</div>
		<div class="header-nav">
			<!-- <a href="{{ url('/admin') }}">首页</a> -->
			<a href="{{ url('/admin/users') }}" @if(\Route::current()->uri() == 'admin/users')class="active"@endif>用户</a>
			<a href="{{ url('/admin/websites') }}" @if(\Route::current()->uri() == 'admin/websites')class="active"@endif>站点</a>
		</div>
		<div class="header-user">
			<small>
			@if (Auth::guard('admin')->check())           
        		骚年，{{ Auth::guard('admin')->user()->name }}，你今天又进步了。
        		<a href="{{ url('/admin/reset') }}">修改密码</a>
        		<a href="{{ url('/admin/logout') }}">退出</a>
        	@endif
        	</small>
		</div>
	</div>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>