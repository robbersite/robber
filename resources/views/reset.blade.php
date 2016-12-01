@extends('master')

@section('content')
    <h2>重置密码</h2>
    <form action="{{ url('/home/reset') }}" method="post">
    {{ csrf_field() }}
    <table class="create">
        <tr>
            <td width="200"><b>新密码</b></td>
            <td>
                <input type="password" name="password" class="form-control"> <small>*</small>
            </td>
        </tr>
        <tr>
            <td width="200"><b>确认密码</b></td>
            <td>
                <input type="password" name="password_confirmation" class="form-control"> <small>*</small>
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