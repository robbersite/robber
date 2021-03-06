<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index($website_id)
    {
        $website = \DB::table('websites')->where('id', $website_id)->first();
        $items = \DB::table('items')->where('website_id', $website_id)->get();
        return view('item', ['website' => $website, 'items' => $items]);
    }

    public function add($website_id){
    	$website = \DB::table('websites')->where('id', $website_id)->first();
    	return view('itemAdd', ['website' => $website]);
    }

    public function insert(Request $request){

        $messages = [
            'title.required' => '标题不能为空',
            'description.required' => '描述不能为空',
            'url.required' => '地址不能为空'
        ];

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'url' => 'required'
        ], $messages);

        $input = [
            'title' => request('title'),
            'description' => request('description'),
            'url' => request('url'),
            'website_id' => request('website_id')
        ];

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb')->store('images', 'upload');
            $input = array_add($input, 'thumb', '/upload/' . $thumb);
        }

        $insert = \DB::table('items')->insert($input);
    
        return redirect('/website/'. request('website_id') .'/item');
    }

    public function edit($website_id, $item_id)
    {   
    	$item = \DB::table('items')->where('id', $item_id)->first();
    	$website = \DB::table('websites')->where('id', $website_id)->first();
    	return view('itemEdit', ['item' => $item, 'website' => $website]);
    }

    public function update(Request $request){

        $messages = [
            'title.required' => '标题不能为空',
            'description.required' => '描述不能为空',
            'url.required' => '地址不能为空'
        ];

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'url' => 'required'
        ], $messages);

        $input = [
            'title' => request('title'),
            'description' => request('description'),
            'url' => request('url'),
        ];

        if ($request->hasFile('thumb')) {
            $thumb = $request->file('thumb')->store('images', 'upload');
            $input = array_add($input, 'thumb', '/upload/' . $thumb);
        }

        $insert = \DB::table('items')->where('id', request('item_id'))->update($input);
    
        return redirect('/website/'. request('website_id') .'/item');
    }

    public function del($website_id, $item_id)
   	{	
   		\DB::table('items')->where('id', $item_id)->delete();
   		return redirect('/website/'. $website_id .'/item');
   	}
}
