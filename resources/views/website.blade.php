@extends('master')

@section('content')
	<form id="search" action=""></form>
	<h2>所有站点<small>({{ count($websites) }})</small>
        <small>
            @if(Gate::allows('add-website'))
                <a href="{{ url('/website/create') }}">新增</a>
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
                    <a href="">获取代码</a>
                    <a href="{{ url('/website/'. $website->id .'/keyword') }}">关键词</a>
                    <a href="{{ url('/website/pinpai', $website->id) }}">品牌推广</a>
                    <a href="{{ url('/website/tuiguang', $website->id) }}">推广</a>
                    <a href="{{ url('/website/guanwang', $website->id) }}">官网</a>
                    <a href="{{ url('/website/baike', $website->id) }}">百科</a>
                    <a href="{{ url('/website/kefu', $website->id) }}">客服电话</a>
                    <!-- <a href="">地图</a> -->
                    <a href="{{ url('/website/item', $website->id) }}"><b>自定义条目</b></a>
                </td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection