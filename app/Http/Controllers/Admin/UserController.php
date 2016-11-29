<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = \DB::table('users')->get();
        return view('admin.users', ['users' => $users]);
    }

    public function setUserGroup($id)
    {
        $user = \DB::table('users')->find($id);

        if($user->group_id == 1){
            \DB::table('users')->where('id', $id)->update(['group_id' => 0]);
        }else{
            \DB::table('users')->where('id', $id)->update(['group_id' => 1]);
        }

        return redirect()->back();
    }

    public function guanwang(Request $request){

        $messages = [
            'title.required' => '标题不能为空',
            'description.required' => '描述不能为空'
        ];

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
        ], $messages);

        $input = [
            'title' => request('title'),
            'description' => request('description'),
            'website_id' => request('website_id')
        ];

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb')->store('images', 'upload');
            $input = array_add($input, 'thumb', '/upload/' . $thumb);
        }

        $guanwang = \DB::table('item_guanwangs')->where('website_id', request('website_id'))->first();

        if(count($guanwang)){
            $insert = \DB::table('item_guanwangs')->where('website_id', request('website_id'))->update($input);
        }else{
            $insert = \DB::table('item_guanwangs')->insert($input);
        }
        
        return redirect()->back();
    }
}
