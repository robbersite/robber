<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PinpaiController extends Controller
{
    public function index($website_id)
    {
        $website = \DB::table('websites')->where('id', $website_id)->first();
        $pinpai = \DB::table('item_pinpais')->where('website_id', $website_id)->first();
        return view('pinpai', ['website' => $website, 'pinpai' => $pinpai]);
    }

    public function pinpai(Request $request){

        $messages = [
            'title.required' => '标题不能为空',
            'description.required' => '描述不能为空',
            // 'thumb.required' => '缩略图不能为空',
            'nav_top.required' => '顶部栏目不能为空',
            // 'nav_thumb.required' => '栏目图不能为空',
            'nav_bottom.required' => '底部栏目不能为空',
            // 'extra_thumb.required' => '右侧缩略图不能为空',
            'extra_description.required' => '右侧描述不能为空',
            'extra_list.required' => '右侧列表不能为空'
        ];

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            // 'thumb' => 'required',
            'nav_top' => 'required',
            // 'nav_thumb' => 'required',
            'nav_bottom' => 'required',
            // 'extra_thumb' => 'required',
            'extra_description' => 'required',
            'extra_list' => 'required',
        ], $messages);

        $input = [
            'title' => request('title'),
            'description' => request('description'),
            'nav_top' => request('nav_top'),
            'nav_bottom' => request('nav_bottom'),
            'extra_description' => request('extra_description'),
            'extra_list' => request('extra_list'),
            'website_id' => request('website_id')
        ];

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb')->store('images', 'upload');
            $input = array_add($input, 'thumb', '/upload/' . $thumb);
        }

        if ($request->hasFile('nav_thumb')) {
            $nav_thumb = $request->file('nav_thumb')->store('images', 'upload');
            $input = array_add($input, 'nav_thumb', '/upload/' . $nav_thumb);
        }

        if ($request->hasFile('extra_thumb')) {
            $extra_thumb = $request->file('extra_thumb')->store('images', 'upload');
            $input = array_add($input, 'extra_thumb', '/upload/' . $extra_thumb);
        }

        $pinpai = \DB::table('item_pinpais')->where('website_id', request('website_id'))->first();

        if(count($pinpai)){
            $insert = \DB::table('item_pinpais')->where('website_id', request('website_id'))->update($input);
        }else{
            $insert = \DB::table('item_pinpais')->insert($input);
        }
        
        if($insert){
            return redirect()->back();
        }
    }
}