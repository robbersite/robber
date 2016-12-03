@extends('master')

@section('content')
	<h2>品牌推广设置 <small><a href="{{ url('/website') }}">所有站点</a></small></h2>
    <form action="{{ url('/website/pinpai') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="website_id" value="{{ $website->id }}">
        <table class="create">
        	<tr>
        		<td width="200">标题</td>
        		<td>
                    <input type="text" name="title" class="form-control" value="{{ $pinpai->title or '' }}">  <small>* 为了达到更真实的效果，标题中应该含有关键词</small>
                </td>
            </tr>
            <tr>
                <td width="200">描述</td>
                <td>
                    <textarea name="description" rows="5" cols="50">{{ $pinpai->description or '' }}</textarea> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">缩略图</td>
                <td>
                    <input type="file" name="thumb" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"></td>
                <td>
                @if(isset($pinpai->thumb))
                    <img src="{{ $pinpai->thumb }}">
                @else
                    没有上传？
                @endif
                </td>
            </tr>
            <tr>
                <td width="200">顶部栏目</td>
                <td>
                    <input type="text" name="nav_top" class="form-control" value="{{ $pinpai->nav_top or '' }}">  <small>* 输入6个栏目名称，格式：栏目1,栏目2,栏目3,栏目4,栏目5,栏目6，栏目名称之间以“,”相隔。</small>
                </td>
            </tr>
            <tr>
                <td width="200">栏目图一</td>
                <td>
                    <input type="file" name="nav_thumb" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"></td>
                <td>
                @if(isset($pinpai->nav_thumb))
                    <img src="{{ $pinpai->nav_thumb }}">
                @else
                    没有上传？
                @endif
                </td>
            </tr>
            <tr>
                <td width="200">栏目图二</td>
                <td>
                    <input type="file" name="nav_thumb_1" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"></td>
                <td>
                @if(isset($pinpai->nav_thumb_1))
                    <img src="{{ $pinpai->nav_thumb_1 }}">
                @else
                    没有上传？
                @endif
                </td>
            </tr>
            <tr>
                <td width="200">底部栏目</td>
                <td>
                    <input type="text" name="nav_bottom" class="form-control" value="{{ $pinpai->nav_bottom or '' }}">  <small>* 输入5个栏目名称，格式：栏目1,栏目2,栏目3,栏目4,栏目5，栏目名称之间以“,”相隔。</small>
                </td>
            </tr>
            <tr>
                <td width="200">右侧缩略图</td>
                <td>
                    <input type="file" name="extra_thumb" class="form-control"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200"></td>
                <td>
                @if(isset($pinpai->extra_thumb))
                    <img src="{{ $pinpai->extra_thumb }}">
                @else
                    没有上传？
                @endif
                </td>
            </tr>
            <tr>
                <td width="200">右侧描述</td>
                <td>
                    <textarea name="extra_description" rows="5" cols="50">{{ $pinpai->extra_description or '' }}</textarea> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">右侧列表</td>
                <td>
                    <input type="text" name="extra_list" class="form-control" value="{{ $pinpai->extra_list or '' }}">  <small>*</small>
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