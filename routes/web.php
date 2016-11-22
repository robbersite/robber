<?php

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', function () {
    return view('one');
});

Route::get('/price', function(){
	return view('price');
});

// 用户中心
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function(){

	// 站点管理
	Route::get('/', 'HomeController@index');
	Route::get('/create', function(){
		return view('createWebsite');
	});
	Route::post('/create', 'HomeController@insertWebsite');
	Route::get('/delete', 'HomeController@deleteWebsite');

	// 关键字
	Route::get('/keyword/{website_id}',  'KeywordController@index');
	Route::post('/keyword', 'KeywordController@keyword');

	// 获取代码
	Route::get('/js/{website_id}', 'JsController@js');

	// 品牌推广
	Route::get('/pinpai/{website_id}', 'PinpaiController@index');
	Route::post('/pinpai', 'PinpaiController@pinpai');

	// 推广
	Route::get('/tuiguang/{website_id}', 'TuiguangController@index');
	Route::post('/tuiguang', 'TuiguangController@tuiguang');

	// 官网
	Route::get('/guanwang/{website_id}', 'GuanwangController@index');
	Route::post('/guanwang', 'GuanwangController@guanwang');

	Route::get('/item', function(){
		return view('item');
	});
});

Route::get('/s', function () {

 	$wd = isset($_GET['wd']) ? trim($_GET['wd']) : 'jd';
 	$pn = isset($_GET['pn']) ? trim($_GET['pn']) : 0;

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, 'http://www.baidu.com/s?&wd=' . $wd . '&pn=' . $pn);
	$data = curl_exec($ch);
	curl_close($ch);

	// 插入品牌
	$pinpai = getPinpai($wd);
	$pos_pinpai = strpos($data, '<div id="content_left">');
	$data = insertToStr($data, $pos_pinpai + 23, $pinpai);

	$pinpai_extra = getPingpaiExtra($wd);
	$pos_pinpai_extra = strpos($data, '<div id="content_right" class="cr-offset">');
	$data = insertToStr($data, $pos_pinpai_extra + 42, $pinpai_extra);

	// 插入推广(在品牌之后)
	$tuiguang = getTuiguang($wd);
	$pos_tuiguang = strpos($data, '<div id="robber_pinpai">');
	$data = insertToStr($data, $pos_tuiguang + 24, $tuiguang);

	// 插入官网(在推广之后)
	$guanwang = getGuanwang($wd);
	$pos_guanwang = strpos($data, '<div id="robber_tuiguang">');
	$data = insertToStr($data, $pos_guanwang + 26, $guanwang);

	// 删除多余的条目
	$removeChild = '
	<script type="text/javascript">
		var child=document.getElementById("1");
		child.parentNode.removeChild(child);
	</script>';
	$pos_removeChild = strpos($data, '</body>');
	$data = insertToStr($data, $pos_removeChild, $removeChild);

	return view('robber')->withData($data);
});

// 获取html:品牌、推广等
Route::group(['prefix' => 'html'], function(){
	Route::get('/pinpai', function(){
		return view('html.pinpai');
	});
	Route::get('/pinpaiExtra', function(){
		return view('html.pinpaiExtra');
	});
	Route::get('/tuiguang', function(){
		return view('html.tuiguang');
	});
	Route::get('/guanwang', function(){
		return view('html.guanwang');
	});
});

// 后台
Route::group(['prefix' => 'admin'], function(){

	Route::get('/login', 'Admin\LoginController@showLoginForm');
	Route::post('/login', 'Admin\LoginController@login');
	Route::get('/logout', 'Admin\LoginController@logout');

	Route::group(['middleware' => 'auth.admin:admin'], function(){
		Route::get('/', function(){
			return view('admin.websites');
		});
	});
});

// 函数
function insertToStr($str, $i, $substr){
    // 指定插入位置前的字符串
    $startstr="";
    for($j=0; $j<$i; $j++){
        $startstr .= $str[$j];
    }
     
    // 指定插入位置后的字符串
    $laststr="";
    for ($j=$i; $j<strlen($str); $j++){
        $laststr .= $str[$j];
    }
     
    // 将插入位置前，要插入的，插入位置后三个字符串拼接起来
    $str = $startstr . $substr . $laststr;
     
    // 返回结果
    return $str;
}

// 获取pinpai
function getPinpai($wd){

	$website = \DB::table('keywords')->where('keyword_default', $wd)->first();

	if(!isset($website)){
		return null;
	}else{
		$item_pinpai = \DB::table('item_pinpais')->where('website_id', $website->website_id)->first();
		$website_url = \DB::table('websites')->find($website->website_id)->url;

		$pos_keyword = strpos($item_pinpai->title, $wd);
		$item_pinpai->title = insertToStr($item_pinpai->title, $pos_keyword, '<em>');
		$pos_keyword = strpos($item_pinpai->title, $wd);
		$item_pinpai->title = insertToStr($item_pinpai->title, $pos_keyword + strlen($wd), '</em>');
	}

	return '<style type="text/css">
	.pinpai{
		border: 1px solid #e3e3e3;
	    border-bottom-color: #e0e0e0;
	    border-right-color: #ececec;
	    -webkit-box-shadow: 1px 2px 1px rgba(0,0,0,0.072);
	    -moz-box-shadow: 1px 2px 1px rgba(0,0,0,0.072);
	    box-shadow: 1px 2px 1px rgba(0,0,0,0.072);
	    width: 520px;
	    padding: 8px 9px 14px 7px;
	    margin-bottom: 20px;
	}
	h2 {
	    margin: 0;
	    padding: 0;
	    font-size: 15px;
	    font-weight: normal;
	    line-height: 20px;
	}
	h2 em {
	    color: #c00;
	    font-style: normal;
	    text-decoration: underline;

	}
	h2 a.title{
		color: #00c;
	}
	.official-site{
		display: inline-block;
	    margin-left: 10px;
	    height: 16px;
	    _height: 14px;
	    padding: 0 6px;
	    _padding-top: 2px;
	    line-height: 16px;
	    _line-height: 14px;
	    overflow: hidden;
	    vertical-align: text-bottom;
	    color: #fff !important;
	    background: #2196ff;
	    font-size: 12px !important;
	    font-family: simsun;
	    text-decoration: none;
	    cursor: pointer;
	    -webkit-border-radius: 1px;
	    -moz-border-radius: 1px;
	    border-radius: 1px;
	}
	.official-site:hover {
    	background: #1e87ef;
	}
	a.thumb{
		float: left;
		width: 121px;
    	height: 121px;
	    margin-top: 1px;
	    margin-right: 10px;
	}
	a.thumb img{
		width: 121px;
    	height: 121px;
    	border: 0;
    	display: block;
	}
	.pinpai-1{
		padding-top: 7px;
		padding-left: 2px;
	}
	.pinpai-1-1{
		font: 13px/1.2 arial,sans-serif;
	    width: auto;
	    overflow: hidden;
    	zoom: 1;
    	line-height: 21px;
    	text-indent: 2em;
    	word-wrap: break-word;
	}
	.pinpai-1-3{
		min-height: 100px;
	}
	.pinpai-1-2{
	    text-indent: 0;
	}
	.pinpai-1-2{
	    padding-top: 1px;
	    word-spacing: -1px;
	    color: #008000;
	}
	.pinpai-1-2 a.brand{
		color: #666;
    	text-decoration: none;
	}
	.pinpai-1-2 a.brand:hover{
		text-decoration: underline;
	}
	.pinpai-2{
		margin:0 0 0 2px;
	}
	.pinpai-2-1{
		background: #fafafa;
	    height: 27px;
	    border-bottom: 1px solid #d9d9d9;
	    padding-right: 0;
	    list-style: none outside none;
	    margin: 10px 0 5px;
	    padding: 0;
	    margin-bottom: 10px;
	}
	.pinpai-2-1 a{
	    float: left;
	    display: block;
	    width: 83px;
	    font-size: 12px;
	    line-height: 14px;
	    text-align: center;
	    text-decoration: none;
	    background: #fafafa;
	    color: #000;
	    border-top: 2px solid #fafafa;
	    padding: 5px 0 6px 0;
	    zoom: 1;
	}
	.pinpai-2-1 a.active{
		border-bottom: 1px solid #fff;
	    border-left: 1px solid #d9d9d9;
	    border-right: 1px solid #d9d9d9;
	    border-top: 2px solid #2c99ff;
	    background: #fff;
	    font-weight: bold;
    }
    .pinpai-2-2{
    	margin-bottom: 10px;
    }
    .pinpai-2-2 img{
    	width:255px;
    	height:96px;
    }
    .pinpai-2-3{
    	background: #9e9e9e;
	    margin-left: 2px;
	    height: 28px;
    }
    .pinpai-2-3 a{
    	color: #fff;
	    text-decoration: none;
	    display: inline-block;
	    border-right: 1px solid #fff;
	    line-height: 1;
	    float: left;
	    height: 16px;
	    line-height: 16px;
	    margin-top: 6px;
	    font-size: 12px;
	    width: 20%;
	    text-align: center;
    }
    .pinpai-2-3 a.last{
    	border-right: none;
    	width: 19%;
    }
</style>
<div class="pinpai">
	<h2>
		<a href="'. $website_url .'" class="title" target="_blank">'. $item_pinpai->title .'</a><a href="'. $website_url .'" class="official-site">官网</a>
	</h2>
	<div class="pinpai-1">
		<a href="'. $website_url .'" class="thumb" target="_blank">
			<img src="'. $item_pinpai->thumb .'">
		</a>
		<div class="pinpai-1-1">
			<div class="pinpai-1-3">
			'. $item_pinpai->description .'
			</div>
			<div class="pinpai-1-2">
				www.JD.com '. date('Y-m', time()) .' - <a href="'. $website_url .'" class="brand" target="_blank">品牌广告</a>
			</div>
		</div>
	</div>
	<div class="pinpai-2">
		<div class="pinpai-2-1">
			<a href="'. $website_url .'" class="active" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
		</div>
		<div class="pinpai-2-2">
			<a href="'. $website_url .'" target="_blank"><img src="'. $item_pinpai->nav_thumb .'"></a>
			<a href="'. $website_url .'" target="_blank"><img src="'. $item_pinpai->nav_thumb .'"></a>
		</div>
		<div class="pinpai-2-3">
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" target="_blank">家用电器</a>
			<a href="'. $website_url .'" class="last" target="_blank">家用电器</a>
		</div>
	</div>
</div><div id="robber_pinpai"></div>
';
}

// 获取pinpaiExtra
function getPingpaiExtra($wd){

	$website = \DB::table('keywords')->where('keyword_default', $wd)->first();

	if(!isset($website)){
		return null;
	}else{
		$item_pinpai = \DB::table('item_pinpais')->where('website_id', $website->website_id)->first();
		$website_url = \DB::table('websites')->find($website->website_id)->url;
	}

	return '<style type="text/css">
	.pinpai-extra{
		font: 13px/1.5 arial,sans-serif;
	    position: relative;
	    width: 351px;
	    border-bottom: 1px solid #e1e1e1;
	    margin-bottom: 20px;
	}
	.pinpai-extra-1{
		margin-bottom: 8px;
	}
	.pinpai-extra-1 img{
		width: 259px;
    	height: 194px;
	}
	.pinpai-extra-2{
		margin-bottom: 8px;
		line-height: 20px;
	}
	.pinpai-extra-2 a{
		text-decoration: none;
    	color: black;
	}
	.pinpai-extra-3{
		margin-bottom: 8px;
	}
	.pinpai-extra-3 span{
		font-size: 9px;
	}
	.pinpai-extra-3 a{
		color: #00c;
	}
	ul{margin:0;padding: 0;list-style: none;line-height: 1.8;}
</style>
<div class="pinpai-extra">
	<div class="pinpai-extra-1">
		<a href="'. $website_url .'" target="_blank"><img src="'. $item_pinpai->extra_thumb .'"></a>
	</div>
	<div class="pinpai-extra-2">
		<a href="'. $website_url .'" target="_blank">'. $item_pinpai->extra_description .'</a>
	</div>
	<div class="pinpai-extra-3">
		<ul>
			<li><span>■</span> <a href="'. $website_url .'" target="_blank">'. $item_pinpai->extra_list .'</a></li>
			<li><span>■</span> <a href="'. $website_url .'" target="_blank">'. $item_pinpai->extra_list .'</a></li>
			<li><span>■</span> <a href="'. $website_url .'" target="_blank">'. $item_pinpai->extra_list .'</a></li>
		</ul>
	</div>
</div>';
}

// 获取tuiguang
function getTuiguang($wd){

	$website = \DB::table('keywords')->where('keyword_default', $wd)->first();

	if(!isset($website)){
		return null;
	}else{
		$item_tuiguang = \DB::table('item_tuiguangs')->where('website_id', $website->website_id)->first();
		$website_url = \DB::table('websites')->find($website->website_id)->url;

		$pos_keyword = strpos($item_tuiguang->title, $wd);
		$item_tuiguang->title = insertToStr($item_tuiguang->title, $pos_keyword, '<em>');
		$pos_keyword = strpos($item_tuiguang->title, $wd);
		$item_tuiguang->title = insertToStr($item_tuiguang->title, $pos_keyword + strlen($wd), '</em>');
	}

	return '<style type="text/css">
	.tuiguang{
		background-color: #FFFAFA !important;
		margin-bottom: 20px;
		width: 539px!important;
	}
	.tuiguang-1 h3{
		font-weight: 400;
	    font-size: medium;
	    margin-bottom: 1px;
	}
	.tuiguang-1 h3 a{
		color: #00c;
	}
	.tuiguang-1 h3 a.extra{
		background: none repeat scroll 0 0 #f5f5f5;
	    color: #666;
	    font-size: 12px;
	    float: right;
	    margin-bottom: -20px;
	    position: relative;
	}
	.tuiguang-2{
		margin: -1px 0 0 0;
		margin: 3px 0 1px;
	}
	.tuiguang-2-1{
	    width: 121px;
	    height: 75px;
	    margin-top: 6px;
	    display: inline-block;
	    overflow: hidden;
	}
	.tuiguang-2-1 img{
		width: 121px;
	    height: 75px;
	    display: block;
	}
	.tuiguang-2-2{
		height: 80px;
	    margin-top: 2px;
	    float: right;
	    width: 402px;
	    font-size: 13px;
	}
	.tuiguang-3{
		margin-top: 5px;
	}
	.tuiguang-3 a.url, .tuiguang-3 a.date{
		color: green;
		line-height: 15px;
		font-size: 13px;
		font-family: arial;
		text-decoration: none;
	}
	.tuiguang-3 a.icon-v{
		background: url(https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/global/img/icons_5859e57.png) no-repeat 0 0;
		display: inline-block;
	    width: 19px;
	    height: 14px;
	    vertical-align: text-bottom;
	    font-style: normal;
	    overflow: hidden;
	    background-position: -936px -192px;
	    border: 1px solid #FFFAFA;
	    margin: 0 5px 0 3px;
	}
	.tuiguang-3 a.icon-v:hover{
		border-color: #ffb300;
	}
	.tuiguang-3 a.pj{
		font-size: 13px;
		color: #666;
		font-family: arial;
	}
	.tuiguang-3 span{
		color: #666;font-size: 13px;
	}
</style>
<div class="tuiguang">
	<div class="tuiguang-1">
		<h3>
			<a href="'. $website_url .'" target="_blank">'. $item_tuiguang->title .'</a>
			<a href="'. $website_url .'" class="extra" target="_blank">广告</a>
		</h3>
	</div>
	<div class="tuiguang-2">
		<div class="tuiguang-2-1">
			<a href="'. $website_url .'" target="_blank">
				<img src="'. $item_tuiguang->thumb .'">
			</a>
		</div>
		<div class="tuiguang-2-2">
			'. $item_tuiguang->description .'
			<div class="tuiguang-3">
				<a href="'. $website_url .'" class="url" target="_blank">'. $website_url .'</a>
				<a href="'. $website_url .'" class="date" target="_blank">'. date('Y-m', time()) .'</a>
				<a href="'. $website_url .'" class="icon-v" target="_blank"></a>
				<span>-</span>
				<a href="'. $website_url .'" class="pj" target="_blank">'. rand(0, 9999) .'条评价</a>
			</div>
		</div>
	</div>
	
</div><div id="robber_tuiguang"></div>';
}

function getGuanwang($wd){

	$website = \DB::table('keywords')->where('keyword_default', $wd)->first();

	if(!isset($website)){
		return null;
	}else{
		$item_guanwang = \DB::table('item_guanwangs')->where('website_id', $website->website_id)->first();
		$website_url = \DB::table('websites')->find($website->website_id)->url;

		$pos_keyword = strpos($item_guanwang->title, $wd);
		$item_guanwang->title = insertToStr($item_guanwang->title, $pos_keyword, '<em>');
		$pos_keyword = strpos($item_guanwang->title, $wd);
		$item_guanwang->title = insertToStr($item_guanwang->title, $pos_keyword + strlen($wd), '</em>');
	}

	return '<style type="text/css">
	.guanwang{
		margin-bottom: 20px;
		width: 539px!important;
	}
	.guanwang-1 h3{
		font-weight: 400;
	    font-size: medium;
	    margin-bottom: 1px;
	}
	.guanwang-1 h3 a{
		color: #00c;
	}
	.guanwang-1 h3 a.extra{
		text-decoration: none;
		padding-left: 5px;
    	padding-right: 5px;
    	background-color: #2b99ff;
    	display: inline-block;
	    padding: 2px 5px;
	    text-align: center;
	    vertical-align: text-bottom;
	    font-size: 12px;
	    line-height: 100%;
	    font-style: normal;
	    font-weight: 400;
	    color: #fff;
	    overflow: hidden;
	    margin-left: 10px;
	}
	.guanwang-2{
		margin: -1px 0 0 0;
		margin: 3px 0 1px;
	}
	.guanwang-2-1{
	    width: 121px;
	    height: 75px;
	    margin-top: 6px;
	    display: inline-block;
	    overflow: hidden;
	}
	.guanwang-2-1 img{
		width: 121px;
	    height: 75px;
	    display: block;
	}
	.guanwang-2-2{
		height: 80px;
	    margin-top: 2px;
	    float: right;
	    width: 402px;
	    font-size: 13px;
	}
	.guanwang-3{
		margin-top: 5px;
	}
	.guanwang-3 a.url, .tuiguang-3 a.date{
		color: green;
		line-height: 15px;
		font-size: 13px;
		font-family: arial;
		text-decoration: none;
	}
	.guanwang-3 a.icon-v{
		background: url(https://ss1.bdstatic.com/5eN1bjq8AAUYm2zgoY3K/r/www/cache/static/protocol/https/global/img/icons_5859e57.png) no-repeat 0 0;
		display: inline-block;
	    width: 19px;
	    height: 14px;
	    vertical-align: text-bottom;
	    font-style: normal;
	    overflow: hidden;
	    background-position: -936px -192px;
	    border: 1px solid #FFFAFA;
	    margin: 0 5px 0 3px;
	}
	.guanwang-3 a.icon-v:hover{
		border-color: #ffb300;
	}
	.guanwang-3 a.pj{
		font-size: 13px;
		color: #666;
		font-family: arial;
	}
	.guanwang-3 span{
		color: #666;font-size: 13px;
	}
</style>
<div class="guanwang">
	<div class="guanwang-1">
		<h3><a href="'. $website_url .'" target="_blank">'. $item_guanwang->title .'</a> <a href="'. $website_url .'" target="_blank" class="extra">官网</a></h3>
	</div>
	<div class="guanwang-2">
		<div class="guanwang-2-1">
			<a href="'. $website_url .'" target="_blank"><img src="'. $item_guanwang->thumb .'"></a>
		</div>
		<div class="guanwang-2-2">
			'. $item_guanwang->description .'
			<div class="guanwang-3">
				<a href="'. $website_url .'" target="_blank" class="url">'. $website_url .'</a>
				<a href="'. $website_url .'" target="_blank" class="icon-v"></a>
				<span>-</span>
				<a href="'. $website_url .'" target="_blank" class="pj">'. rand(0, 9999) .'</a>
			</div>
		</div>
	</div>
</div>';
}