@extends('admin.master')

@section('content')
	<form id="search" action=""></form>
	<h2>所有用户<small>({{ count($users) }})</small><input type="" name="" form="search" placeholder="用户名或邮箱"></h2>
    <table>
    	<tr>
    		<th>序号</th>
    		<th>用户名</th>
    		<th>邮箱</th>
    		<th>用户组</th>
    		<th>创建时间</th>
    		<th>管理</th>
    	</tr>
        @foreach($users as $user)
    	<tr>
    		<td>{{ $loop->index + 1 }}</td>
    		<td>{{ $user->name }}</td>
    		<td>{{ $user->email }} <span class="color-green" style="float:right;">已验证</span></td>
    		<td>
                @if($user->group_id === 1)
                    <span class="color-red">代理用户</span>
                @else
                    <span class="color-grey">普通用户</span>
                @endif
            </td>
    		<td>{{ $user->created_at }}</td>
    		<td>
                @if($user->group_id === 1)
                    <a href="{{ url('/admin/setUserGroup', $user->id) }}">取消代理</a>
                @else
                    <a href="{{ url('/admin/setUserGroup', $user->id) }}">设为代理</a>
                @endif
                <a href="{{ url('/admin/user/website', $user->id) }}">站点</a>
                <a href="">删除</a>
            </td>
    	</tr>
        @endforeach
    </table>
@endsection