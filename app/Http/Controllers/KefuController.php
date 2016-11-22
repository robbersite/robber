<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KefuController extends Controller
{
    public function index($website_id)
    {
        $website = \DB::table('websites')->where('id', $website_id)->first();
        $kefu = \DB::table('item_kefus')->where('website_id', $website_id)->first();
        return view('kefu', ['website' => $website, 'kefu' => $kefu]);
    }

    public function kefu(Request $request){

        $messages = [
            'title.required' => '标题不能为空',
            'tel.required' => '电话不能为空'
        ];

        $this->validate($request, [
            'title' => 'required',
            'tel' => 'required',
        ], $messages);

        $input = [
            'title' => request('title'),
            'tel' => request('tel'),
            'website_id' => request('website_id')
        ];

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb')->store('images', 'upload');
            $input = array_add($input, 'thumb', '/upload/' . $thumb);
        }

        $kefu = \DB::table('item_kefus')->where('website_id', request('website_id'))->first();

        if(count($kefu)){
            $insert = \DB::table('item_kefus')->where('website_id', request('website_id'))->update($input);
        }else{
            $insert = \DB::table('item_kefus')->insert($input);
        }
        
        return redirect()->back();
    }
}
