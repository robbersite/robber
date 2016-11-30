<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $websites = \DB::table('websites')->where('user_id', \Auth::user()->id)->get();
        return view('website', ['websites' => $websites]);
    }

    public function create(Request $request){

        $messages = [
            'name.required' => '站点名称不能为空',
            'url.required' => '站点地址不能为空'
        ];

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
        ], $messages);

        $website_id = \DB::table('websites')->insertGetId(
            ['name' => request('name'), 'url' => request('url'), 'user_id' => \Auth::user()->id]
        );

        // 增加一个站点的同时，开通一天时间
        \DB::table('website_orders')->insert([
            'start' => time(),
            'stop' => time() + 3600*24,
            'last' => 1,
            'website_id' => $website_id
        ]);

        return redirect('/website');
    }

    public function deleteWebsite(){}
}
