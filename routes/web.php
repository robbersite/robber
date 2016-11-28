<?php

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

// 首页
Route::get('/', function () {
    return view('one');
});

// 用户中心
Route::group(['prefix' => 'home', 'middleware' => 'auth'], function(){

	// 站点管理
	Route::get('/', 'HomeController@index');

	// 通过中间件和Gates来控制普通用户和代理用户
	Route::group(['middleware' => 'user'], function(){
		Route::get('/create', function(){
			return view('createWebsite');
		});
		Route::post('/create', 'HomeController@insertWebsite');
		Route::get('/delete', 'HomeController@deleteWebsite');
	});
	
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

	// 官网
	Route::get('/baike/{website_id}', 'BaikeController@index');
	Route::post('/baike', 'BaikeController@baike');

	// 客服电话
	Route::get('/kefu/{website_id}', 'KefuController@index');
	Route::post('/kefu', 'KefuController@kefu');

	// 自定义条目
	Route::get('/item/{website_id}', 'ItemController@index');
	Route::get('/item/{website_id}/add', 'ItemController@add');
	Route::post('/item/add', 'ItemController@insert');
	Route::get('/item/edit/{item_id}/website/{website_id}', 'ItemController@edit');
	Route::post('item/update', 'ItemController@update');
	Route::get('/item/del/{item_id}/website/{website_id}', 'ItemController@del');
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
	$pos_tuiguang = strpos($data, '<div id="robber_pinpai"></div>');
	$data = insertToStr($data, $pos_tuiguang + 30, $tuiguang);

	// 插入官网(在推广之后)
	$guanwang = getGuanwang($wd);
	$pos_guanwang = strpos($data, '<div id="robber_tuiguang"></div>');
	$data = insertToStr($data, $pos_guanwang + 32, $guanwang);

	// 插入百科(在官网之后)
	$baike = getBaike($wd);
	$pos_baike = strpos($data, '<div id="robber_guanwang"></div>');
	$data = insertToStr($data, $pos_baike + 32, $baike);

	// 插入客服(在百科之后)
	$baike = getKefu($wd);
	$pos_baike = strpos($data, '<div id="robber_baike"></div>');
	$data = insertToStr($data, $pos_baike + 29, $baike);

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
	Route::get('/baike', function(){
		return view('html.baike');
	});
	Route::get('/kefu', function(){
		return view('html.kefu');
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