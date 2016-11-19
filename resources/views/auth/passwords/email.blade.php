<!DOCTYPE html>
<html>
<head>
    <title>发送邮件 - 极盗者</title>
    <style type="text/css">
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
        }
        h2{
            font-weight: 500;
        }
        form{
            width: 300px;
            padding: 30px;
            margin: 0 auto;
            background-color: #f0f0f0;
            border: solid 1px #e7e7e7;
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
            font-size: 14px;
            font-weight: bold;
        }
        button:hover{
            background-color: #0c7cd5;
        }
        .extra a{
            color: #333;
            font-size: 12px;
        }
        .errors p{
            font-size: 12px;
            color: #e51c23;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>极盗者 <small>发送邮件</small></h2>
        @if (count($errors) > 0 )
            <div class="errors">
                <p>这些凭据不符合我们的记录！</p>
            </div>
        @endif
        @if (session('status'))
            <div class="errors">
                <p>{{ session('status') }}</p>
            </div>
        @endif
        <form method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="item">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="邮箱" required>
            </div>
            <button type="submit">发送密码重置链接</button>
        </form>
    </div>
</body>
</html>
 
