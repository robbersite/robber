<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $websites = \DB::table('websites')->where('user_id', \Auth::user()->id)->get();
        return view('home', ['websites' => $websites]);
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
