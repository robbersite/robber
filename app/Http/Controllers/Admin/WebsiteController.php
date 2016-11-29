<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{

    public function index()
    {   
        $websites = \DB::table('websites')->get();
        return view('admin.websites', ['websites' => $websites]);
    }

    public function insertWebsite(Request $request){

        $messages = [
            'name.required' => '站点名称不能为空',
            'url.required' => '站点地址不能为空'
        ];

        $this->validate($request, [
            'name' => 'required',
            'url' => 'required',
        ], $messages);

        $insert = \DB::table('websites')->insert(
            ['name' => request('name'), 'url' => request('url'), 'user_id' => \Auth::user()->id]
        );

        if($insert){
            return redirect()->back();
        }
    }

    public function deleteWebsite(){}
}
