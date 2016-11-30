@extends('master')

@section('content')
    <h2>个人中心</h2>
    <table>
        <tr>
            <td width="200"><b>用户名</b></td>
            <td>
                {{ $user->name }}
            </td>
        </tr>
        <tr>
            <td width="200"><b>邮箱</b></td>
            <td>
                <p>{{ $user->email }}</p>
                <p>未验证 <a href="">发送验证链接</a></p>
            </td>
        </tr>
        <tr>
            <td width="200"><b>密码</b></td>
            <td>
                <a href="{{ url('/home/reset') }}">重置密码</a>
            </td>
        </tr>
        <tr>
            <td width="200"><b>用户组</b></td>
            <td>
                @if($user->group_id === 1)
                    <span class="color-warning">代理用户</span>
                @else
                    <span class="color-grey">普通用户</span>
                @endif
            </td>
        </tr>
        <tr>
            <td width="200"><b>站点</b></td>
            <td>
                <p><a href="">所有(8)</a></p>
                <p><a href="" class="color-danger">到期(2)</a></p>
                <p><a href="" class="color-default">过期(2)</a></p>
            </td>
        </tr>
    </table>
@endsection