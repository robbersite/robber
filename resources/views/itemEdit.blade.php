@extends('master')

@section('content')
    <h2>新增条目 <small><a href="{{ url('/home/item', ['website_id' => $website->id]) }}">所有条目</a></small></h2>
    <form action="{{ url('/home/item/update') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table class="create">
            <tr>
                <td width="200">标题</td>
                <td>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $item->title) }}"> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">描述</td>
                <td>
                    <textarea name="description" rows="5" cols="50">{{ old('description', $item->description) }}</textarea> <small>*</small>
                </td>
            </tr>
            <tr>
                <td width="200">地址</td>
                <td>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $item->url) }}"> <small>*</small>
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
                    <button type="submit">保存</button>
                </td>
            </tr>
        </table>
    </form>
@endsection