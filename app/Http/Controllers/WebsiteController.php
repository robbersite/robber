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

    public function add(Request $request){

        $messages = [
            'name.required' => '站点名称不能为空',
            'url.required' => '站点地址不能为空'
        ];

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
        ], $messages);

        $website_id = \DB::table('websites')->insertGetId(
            ['name' => request('name'), 'url' => request('url'), 'user_id' => \Auth::user()->id, 'domain' => str_random(32)]
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

    public function edit($website_id)
    {
        $website = \DB::table('websites')->find($website_id);
        return view('websiteEdit', ['website' => $website]);
    }

    public function update(Request $request){

        $messages = [
            'name.required' => '站点名称不能为空',
            'url.required' => '站点地址不能为空'
        ];

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
        ], $messages);

        \DB::table('websites')->where('id', request('website_id'))->update(
            ['name' => request('name'), 'url' => request('url')]
        );

        return redirect()->back();
    }

    public function order($website_id)
    {
        $orders = \DB::table('website_orders')->where('website_id', $website_id)->orderBy('id', 'desc')->get();
        return view('order', ['orders' => $orders, 'website_id' => $website_id]);
    }

    public function orderAdd(Request $request)
    {
        $messages = [
            'last.required' => '投放周期不能为空',
            'last.integer' => '投放周期必须为整数'
        ];

        $this->validate($request, [
            'last' => 'required|integer',
        ], $messages);

        // 判断之前的投放是否到期
        $order_last = \DB::table('website_orders')->where('website_id', request('website_id'))->get()->last();
        $diff = $order_last->stop - time();

        if($diff > 0 || $diff == 0){
            \DB::table('website_orders')->insert([
                'start' => $order_last->stop,
                'stop' => $order_last->stop + request('last') * 24 * 3600,
                'last' => request('last'),
                'website_id' => request('website_id')
            ]);
        }else{
            \DB::table('website_orders')->insert([
                'start' => time(),
                'stop' => time() + request('last') * 24 * 3600,
                'last' => request('last'),
                'website_id' => request('website_id')
            ]);
        }

        return redirect('/website/'. request('website_id') .'/order');
    }

    public function del($website_id)
    {
        // 删除站点
        \DB::table('item_baikes')->where('website_id', $website_id)->delete();
        \DB::table('item_guanwangs')->where('website_id', $website_id)->delete();
        \DB::table('item_kefus')->where('website_id', $website_id)->delete();
        \DB::table('item_pinpais')->where('website_id', $website_id)->delete();
        \DB::table('item_tuiguangs')->where('website_id', $website_id)->delete();
        \DB::table('items')->where('website_id', $website_id)->delete();
        \DB::table('keywords')->where('website_id', $website_id)->delete();
        \DB::table('website_orders')->where('website_id', $website_id)->delete();
        \DB::table('websites')->where('id', $website_id)->delete();

        return redirect()->back();
    }
}
