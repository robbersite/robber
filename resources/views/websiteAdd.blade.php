@extends('master')

@section('content')
	<h2>新增站点 <small><a href="{{ url('/website') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/create') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{ Auth::guard()->user()->id }}">
        <table class="create">
        	<tr>
        		<td width="200">站点名称</td>
        		<td>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">站点地址</td>
                <td>
                    <input type="text" name="url" class="form-control" value="{{ old('url') }}"> <small>* 格式：http://www.baidu.com</small>
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