<!DOCTYPE html>
<html>
<head>
	<title>管理中心 - 极盗者</title>
	<link href="//cdn.bootcss.com/normalize/5.0.0/normalize.min.css" rel="stylesheet">
	<link href="/css/home.css" rel="stylesheet">
</head>
<body>
	<div class="header">
		<div class="header-brand">
			<a href="{{ url('/') }}">极盗者</a>
		</div>
		<div class="header-nav">
			<a href="{{ url('/home') }}"  @if(\Route::current()->uri() == 'home')class="active"@endif>个人</a>
			<a href="{{ url('/website') }}" @if(\Route::current()->uri() == 'website')class="active"@endif>站点</a>
		</div>
		<div class="header-user">
			<small>
			@if (Auth::guard()->check())           
        		{{ Auth::guard()->user()->name }}
        		<a href="{{ url('/logout') }}">登出</a>
        	@endif
        	</small>
		</div>
	</div>

	@if (count($errors) > 0 )
	    <div class="errors">
	        @foreach ($errors->all() as $error)
	            <span>· {{ $error }}</span>
	        @endforeach
	    </div>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>
</html>