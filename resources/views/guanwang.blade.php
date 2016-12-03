@extends('master')

@section('content')
	<h2>推广设置 <small><a href="{{ url('/home') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/guanwang') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200">标题</td>
        		<td>
                    <input type="text" name="title" class="form-control" value="{{ $guanwang->title or '' }}">  <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">描述</td>
                <td>
                    <textarea name="description" rows="5" cols="50">{{ $guanwang->description or '' }}</textarea> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">缩略图</td>
                <td>
                    <input type="file" name="thumb" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"></td>
                <td>
                @if(isset($guanwang->thumb))
                    <img src="{{ $guanwang->thumb }}">
                @else
                    没有上传？
                @endif
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