<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuanwangController extends Controller
{
    public function index($website_id)
    {
        $website = \DB::table('websites')->where('id', $website_id)->first();
        $guanwang = \DB::table('item_guanwangs')->where('website_id', $website_id)->first();
        return view('guanwang', ['website' => $website, 'guanwang' => $guanwang]);
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
