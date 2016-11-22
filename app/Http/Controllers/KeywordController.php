<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeywordController extends Controller
{   
    public function index($website_id){

        $website = \DB::table('websites')->where('id', $website_id)->first();
        $keyword = \DB::table('keywords')->where('website_id', $website_id)->first();
        return view('keyword', ['website' => $website, 'keyword' => $keyword]);
    }

    public function keyword(Request $request){

        $messages = [
            'keyword_default.required' => '默认关键词不能为空',
            'keyword_trigger.required' => '触发关键词不能为空'
        ];

        $this->validate($request, [
            'keyword_default' => 'required',
            'keyword_trigger' => 'required',
        ], $messages);

        $keyword = \DB::table('keywords')->where('website_id', request('website_id'))->first();

        if(count($keyword)){
            $insert = \DB::table('keywords')->where('website_id', request('website_id'))->update([
                'keyword_default' => request('keyword_default'),
                'keyword_trigger' => request('keyword_trigger'),
                'matching' => request('matching'),
            ]);
        }else{
            $insert = \DB::table('keywords')->insert([
                'keyword_default' => request('keyword_default'),
                'keyword_trigger' => request('keyword_trigger'),
                'matching' => request('matching'),
                'website_id' => request('website_id')
            ]);
        }

        return redirect()->back();
    }
}
