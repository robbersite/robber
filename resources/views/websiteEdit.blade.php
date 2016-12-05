@extends('master')

@section('content')
	<h2>编辑站点 <small><a href="{{ url('/website') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/update') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200"><b>站点名称</b></td>
        		<td>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $website->name) }}"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"><b>站点地址</b></td>
                <td>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $website->url) }}"> <small>* 格式：http://www.baidu.com</small>
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