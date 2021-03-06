<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user = \DB::table('users')->find(\Auth::user()->id);
        return view('home', ['user' => $user]);
    }

    public function reset(Request $request)
    {
        $info = [
            'password.required' => '密码不能为空',
            'password.confirmed' => '确认密码不匹配',
            'password.min' => '密码最小长度为6位字符',
        ];

        $this->validate($request, [
            'password' => 'required|min:6|confirmed',
        ], $info);

        \DB::table('users')->where('id', \Auth::guard()->user()->id)->update([
            'password' => bcrypt(request('password')),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/home');
    }
}
