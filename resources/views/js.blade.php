@extends('master')

@section('content')
	<h2>获取代码 <small><a href="{{ url('/website') }}">所有站点</a></small></small></h2>
    <table>
    	<tr>
            <td width="200"><b>代码</b></td>
            <td>{!! $js !!}</td>
    	</tr>
    </table>
@endsection