@extends('master')

@section('content')
	<h2>关键词设置  <small><a href="{{ url('/website') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/keyword') }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200">默认关键词</td>
        		<td>
                    <input type="text" name="keyword_default" class="form-control" value="{{ $keyword->keyword_default or ''}}"> <small>* 被劫持后输入框显示的关键词</small>
                </td>
            </tr>
            <tr>
                <td width="200">触发关键词</td>
                <td>
                    <input type="text" name="keyword_trigger" class="form-control" value="{{ $keyword->keyword_trigger or '' }}"> <small>* 用户输入的内容与关键词匹配时触发显示结果</small>
                </td>
        	</tr>
            <tr>
                <td width="200">匹配类型</td>
                <td>
                    <select name="matching">
                        <option value="0">模糊匹配</option>
                        <option value="1">完全匹配</option>
                    </select>
                    <small>* 模糊匹配：用户输入<mark>包含</mark>设置关键词即匹配成功。完全匹配：用户输入<mark>等于</mark>设置关键词才匹配成功。</small>
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