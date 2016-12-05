<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
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

        \DB::table('admins')->where('id', \Auth::guard('admin')->user()->id)->update([
            'password' => bcrypt(request('password')),
            'remember_token' => Str::random(60),
        ]);

        return redirect('/admin');
    }
}
