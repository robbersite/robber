@extends('master')

@section('content')
	<h2>新增投放 <small><a href="{{ url('/website/'. $website->id .'/order') }}">投放记录</a></small></h2>
    <form action="{{ url('/website/order/add') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200"><b>站点名称</b></td>
        		<td>
                    <input type="text" name="name" class="form-control" value="{{ $website->name }}" disabled="disabled">
                </td>
            </tr>
            <tr>
                <td width="200"><b>站点地址</b></td>
                <td>
                    <input type="text" name="url" class="form-control" value="{{ $website->url }}" disabled="disabled">
                </td>
            </tr>
            <tr>
                <td width="200"><b>投放周期</b></td>
                <td>
                    <input type="text" name="last" class="form-control" value="{{ old('last') }}"> <small>天 * 说明：投放之后，若没有到期，则从上次投放到期之日的第二天算起；若已经到期，则从当日算起。</small>
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