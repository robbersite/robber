@extends('master')

@section('content')
	<form id="search" action=""></form>
	<h2>所有站点<small>({{ count($websites) }})</small>
        <small>
            @if(Gate::allows('add-website'))
                <a href="{{ url('/website/add') }}">新增</a>
            @endif
        </small>
        <input type="" name="" form="search" placeholder="站点名称或地址">
    </h2>
    <table>
    	<tr>
    		<th>序号</th>
    		<th>站点名称</th>
    		<th>站点地址</th>
    		<th>投放渠道</th>
    		<th>投放周期(天)</th>
            <th>开始时间</th>
    		<th>到期时间</th>
            <th>生成代码</th>
            <th>关键词</th>
            <th>展示设置</th>
    		<th>管理</th>
    	</tr>
        @if(!count($websites))
            <tr><td colspan="8">暂无可用站点</td></tr>
        @else
            @foreach($websites as $website)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $website->name }}</td>
                <td><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></td>
                <td>百度</td>
                <td>{{ \DB::table('website_orders')->where('website_id', $website->id)->first()->last }}</td>
                <td>{{ date('Y-m-d', \DB::table('website_orders')->where('website_id', $website->id)->first()->start) }}</td>
                <td>{{ date('Y-m-d', \DB::table('website_orders')->where('website_id', $website->id)->first()->stop) }}</td>
                <td>
                    <a href="{{ url('/website/'. $website->id .'/js') }}">生成代码</a>
                </td>
                <td>
                    <a href="{{ url('/website/'. $website->id .'/keyword') }}">关键词</a>
                </td>
                <td>
                    <a href="{{ url('/website/'. $website->id .'/pinpai') }}">品牌推广</a>
                    <a href="{{ url('/website/'. $website->id .'/tuiguang') }}">推广</a>
                    <a href="{{ url('/website/'. $website->id .'/guanwang') }}">官网</a>
                    <a href="{{ url('/website/'. $website->id .'/baike') }}">百科</a>
                    <a href="{{ url('/website/'. $website->id .'/kefu') }}">客服电话</a>
                    <a href="">地图</a>
                    <a href="{{ url('/website/'. $website->id .'/item') }}">自定义条目</a>
                </td>
                <td>
                    <a href="{{ url('/website/'. $website->id .'/edit') }}">编辑</a>
                    @if(Gate::allows('add-website'))
                        <a href="{{ url('/website/'. $website->id .'/del') }}">删除</a>
                    @endif
                    <a href="{{ url('/website/'. $website->id .'/order') }}">投放</a>
                </td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection