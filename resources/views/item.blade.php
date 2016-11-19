@extends('master')

@section('content')
	<h2>设置 <a href="{{ url('/home') }}" class="btn">所有站点</a></h2>
    <div><a href="">关键字设置</a></div>
    <form action="{{ url('/home/create') }}" method="post">
        {{ csrf_field() }}
        <table class="create">
        	<tr>
        		<td width="200">站点名称</td>
        		<td>
                    <input type="" name="name" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">站点地址</td>
                <td>
                    <input type="" name="url" class="form-control"> <small>* 例：http://www.baidu.com</small>
                </td>
        	</tr>
            <tr>
                <td width="200"></td>
                <td>
                    <button type="submit">保存</button>
                </td>
            </tr>
        </table>
    </form>
@endsection