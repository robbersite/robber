@extends('master')

@section('content')
	<h2>客服电话设置 <small><a href="{{ url('/website') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/kefu') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200">标题</td>
        		<td>
                    <input type="text" name="title" class="form-control" value="{{ $kefu->title or '' }}"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">电话</td>
                <td>
                    <input type="text" name="tel" class="form-control" value="{{ $kefu->tel or '' }}"> <small>*</small>
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