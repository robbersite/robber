<!DOCTYPE html>
<html>
<head>
    <title>注册 - 极盗者</title>
    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            background-color: #f0f0f0;
        }
        h2{
            font-weight: 500;
        }
        form{
            width: 300px;
            padding: 30px;
            margin: 0 auto;
            background-color: #fff;
        }
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .form-control{
            border:solid 1px #e7e7e7;
            width: 300px;
            outline: none;
            height: 40px;
            text-indent: 10px;
            transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
        }
        .item{
            margin-bottom: 15px;
        }
        .form-control:focus{
            border: solid 1px #c5c5c5;
        }
        button{
            border:none;
            width: 300px;
            outline: none;
            height: 42px;
            background-color: #2196f3;
            cursor: pointer;
            color: #fff;
            margin-top: 15px;
            font-size: 14px;
            font-weight: bold;
        }
        button:hover{
            background-color: #0c7cd5;
        }
        .extra a{
            color: #666;
            font-size: 12px;
            margin-top: 15px;
        }
        .errors p{
            font-size: 12px;
            color: #e51c23;
        }
        .footer a{
            color: #666;
            font-size: 14px;
        }
        a:hover{
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>极盗者 <small>注册</small></h2>
        @if (count($errors) > 0 )
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
        <form method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="item">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus autocomplete="off" placeholder="用户名" required>
            </div>
            <div class="item">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="邮箱" required>
            </div>
            <div class="item">
                <input type="password" class="form-control" name="password" autocomplete="off" placeholder="密码" required>
            </div>
            <div class="item">
                <input type="password" class="form-control" name="password_confirmation" placeholder="确认密码" required>
            </div>
            <div class="item">
                <input type="text" class="form-control" name="captcha" autocomplete="off" placeholder="验证码" required style="width: 135px;float:left;"><span style="float:right;display:inline-block;width: 150px;height: 44px;">{!! captcha_img('robber') !!}</span>
            </div>
            <div class="item extra">
                <a href="{{ url('/password/reset') }}" style="float:left;">忘记密码？</a>
                <a href="{{ url('/login') }}" style="float:right;">立即登录</a>
            </div>
            <button type="submit">注册</button>
        </form>
        <p class="footer"><a href="{{ url('/') }}">极盗者</a></p>
    </div>
</body>
</html>