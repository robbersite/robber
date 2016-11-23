@extends('master')

@section('content')
	<form id="search" action=""></form>
	<h2>自定义条目<small>({{ count($items) }})</small> <small><a href="{{ url('/home/item/'. $website->id .'/add') }}">新增</a> <a href="{{ url('/home') }}">所有站点</a></small></small></h2>
    <table>
    	<tr>
    		<th>序号</th>
    		<th>标题</th>
    		<th>描述</th>
    		<th>地址</th>
    		<th>缩略图</th>
    		<th>管理</th>
    	</tr>
        @if(!count($items))
            <tr><td colspan="6">暂无条目</td></tr>
        @else
            @foreach($items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->url }}</td>
                <td><img src="{{ $item->thumb }}"></td>
                <td>
                    <a href="{{ url('/home/item/edit/' . $item->id . '/website/' .$website->id) }}">编辑</a>
                    <a href="{{ url('/home/item/del/' . $item->id . '/website/' .$website->id) }}">删除</a>
                </td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection