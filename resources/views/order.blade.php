@extends('master')

@section('content')
	<h2>投放<small>({{ count($orders) }})</small>
        <small>
            @if(Gate::allows('add-website'))
                <a href="{{ url('/website/'. $website_id .'/order/add') }}">新增</a>
            @endif
        </small>
    </h2>
    <table>
    	<tr>
    		<th>序号</th>
            <th>投放周期(天)</th>
            <th>开始时间</th>
            <th>到期时间</th>
    	</tr>
        @if(!count($orders))
            <tr><td colspan="8">暂无投放记录</td></tr>
        @else
            @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->last }}</td>
                <td>{{ date('Y-m-d', $order->start) }}</td>
                <td>{{ date('Y-m-d', $order->stop) }}</td>
            </tr>
            @endforeach
        @endif
    </table>
@endsection