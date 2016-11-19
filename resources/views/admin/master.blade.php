<!DOCTYPE html>
<html>
<head>
	<title>Robber</title>
	<link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
	<link href="/css/admin.css" rel="stylesheet">
</head>
<body>
	<div class="header">
		<div class="header-brand">
			<a href="">Robber</a>
		</div>
		<div class="header-nav">
			<a href="">首页</a>
			<a href="">用户</a>
			<a href="" class="active">站点</a>
		</div>
		<div class="header-user">
			<small>
			@if (Auth::guard('admin')->check())           
        		骚年<!-- ，{{ Auth::guard('admin')->user()->name }} -->，你今天又进步了。
        		<a href="{{ url('/admin/logout') }}">修改密码</a>
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