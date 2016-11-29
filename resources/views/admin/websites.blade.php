@extends('admin.master')

@section('content')
    <form id="search" action=""></form>
    <h2>所有站点<small>({{ count($websites) }})</small><input type="" name="" form="search" placeholder="站点名称或地址">
    </h2>
    <table>
        <tr>
            <th>序号</th>
            <th>站点名称</th>
            <th>站点地址</th>
            <th>投放渠道</th>
            <th>投放周期</th>
            <th>开始时间</th>
            <th>到期时间</th>
            <th>获取代码</th>
            <th>关键词(默认/触发/类型)</th>
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
                <td>一个月</td>
                <td>2016-10-08</td>
                <td>2016-11-08</td>
                <td>
                    <a href="">获取代码</a>
                </td>
                <td><span class="color-red">贷款 / 广州贷款 / 模糊匹配</span></td>
                <td>
                    <a href="">历史</a>
                    <a href="">设置</a>
                </td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection