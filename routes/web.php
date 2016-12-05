<?php

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

// 首页
Route::get('/', function () {
    return view('one');
});

// 用户中心
Route::group(['middleware' => 'auth'], function(){

	// 管理中心
	Route::group(['prefix' => 'home'], function(){
		Route::get('/', 'HomeController@index');
		Route::get('/reset', function(){
			return view('reset');
		});
		Route::post('/reset', 'HomeController@reset');
	});

	// 站点管理
	Route::group(['prefix' => 'website'], function(){

		Route::get('/', 'WebsiteController@index');

		// 通过中间件和Gates来控制普通用户和代理用户
		Route::group(['middleware' => 'user'], function(){

			// 新增站点
			Route::get('/add', function(){
				return view('websiteAdd');
			});
			Route::post('/add', 'WebsiteController@add');

			// 新增投放，既要控制权限又要控制资源
			Route::get('/{website_id}/order/add', function($website_id){
				$website = \DB::table('websites')->find($website_id);
				return view('orderAdd', ['website' => $website]);
			})->middleware('user.action');

			Route::post('/order/add', 'WebsiteController@orderAdd')->middleware('user.action');

			// 删除站点
			Route::get('/{website_id}/del', 'WebsiteController@del')->middleware('user.action');
		});

		// 资源访问控制：不允许当前用户对其他站点的操作
		Route::group(['middleware' => 'user.action'], function(){

			// 基本管理
			Route::get('/{website_id}/edit', 'WebsiteController@edit');
			Route::post('/update', 'WebsiteController@update');

			// 投放记录
			Route::get('/{website_id}/order', 'WebsiteController@order');

			// 获取代码
			Route::get('/{website_id}/js', 'JsController@js');

			// 关键字
			Route::get('/{website_id}/keyword', 'KeywordController@index');
			Route::post('/keyword', 'KeywordController@keyword');

			// 品牌推广
			Route::get('/{website_id}/pinpai', 'PinpaiController@index');
			Route::post('/pinpai', 'PinpaiController@pinpai');

			// 推广
			Route::get('/{website_id}/tuiguang', 'TuiguangController@index');
			Route::post('/tuiguang', 'TuiguangController@tuiguang');

			// 官网
			Route::get('/{website_id}/guanwang', 'GuanwangController@index');
			Route::post('/guanwang', 'GuanwangController@guanwang');

			// 官网
			Route::get('/{website_id}/baike', 'BaikeController@index');
			Route::post('/baike', 'BaikeController@baike');

			// 客服电话
			Route::get('/{website_id}/kefu', 'KefuController@index');
			Route::post('/kefu', 'KefuController@kefu');

			// 自定义条目
			Route::get('/{website_id}/item', 'ItemController@index');
			Route::get('/{website_id}/item/add', 'ItemController@add');
			Route::post('/item/add', 'ItemController@insert');
			Route::get('/{website_id}/item/{item_id}/edit', 'ItemController@edit');
			Route::post('/item/update', 'ItemController@update');
			Route::get('/{website_id}/item/{item_id}/del', 'ItemController@del');
		});
		
	});
});

Route::group(['domain' => 'www.baidu.com.{domain}.robber.site'], function () {
    Route::get('/s', function ($domain) {

    	// 默认关键词设置
    	$website = \DB::table('websites')->where('domain', $domain)->first();
    	$keyword = \DB::table('keywords')->where('website_id', $website->id)->first();

        $wd = !empty($_GET['wd']) ? trim($_GET['wd']) : $keyword->keyword_default;
	 	$pn = isset($_GET['pn']) ? trim($_GET['pn']) : 0;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, 'http://www.baidu.com/s?&wd=' . $wd . '&pn=' . $pn);
		$data = curl_exec($ch);
		curl_close($ch);

		// 判断是否curl成功
		if(!$data){
			return redirect(url()->full());
		}
		
		// 判断是否匹配到关键词
		$stristr_trigger = stristr($wd, $keyword->keyword_trigger);
		$stristr_default = stristr($wd, $keyword->keyword_default);

		// 匹配类型
		switch ($keyword->matching) {
			case 1:
				if($wd != $keyword->keyword_trigger){
					$stristr_trigger = '';
					$stristr_default = '';
				}
				break;
			default:
				break;
		}

		if($stristr_trigger || $stristr_default){
			$i = 0;
			// 插入品牌
			$pinpai = getPinpai($wd, $domain);
			$pos_pinpai = strpos($data, '<div id="content_left">');
			if($pos_pinpai){
				$i++;
				$data = insertToStr($data, $pos_pinpai + 23, $pinpai);
				
				$pinpai_extra = getPingpaiExtra($wd, $domain);
				$pos_pinpai_extra = strpos($data, '<div id="content_right" class="cr-offset">');
				$data = insertToStr($data, $pos_pinpai_extra + 42, $pinpai_extra);
			}

			// 插入推广(在品牌之后)
			$tuiguang = getTuiguang($wd, $domain);
			$pos_tuiguang = strpos($data, '<div id="robber_pinpai"></div>');
			if($pos_tuiguang){
				$i++;
				$data = insertToStr($data, $pos_tuiguang + 30, $tuiguang);
			}else{
				$pos_tuiguang = strpos($data, '<div id="content_left">');
				$data = insertToStr($data, $pos_tuiguang + 23, $tuiguang);
			}

			// 插入官网(在推广之后)
			$guanwang = getGuanwang($wd, $domain);
			$pos_guanwang = strpos($data, '<div id="robber_tuiguang"></div>');
			if($pos_guanwang){
				$i++;
				$data = insertToStr($data, $pos_guanwang + 32, $guanwang);
			}elseif($pos_tuiguang){
				$pos_guanwang = strpos($data, '<div id="robber_pinpai"></div>');
				$data = insertToStr($data, $pos_guanwang + 30, $guanwang);
			}else{
				$pos_guanwang = strpos($data, '<div id="content_left">');
				$data = insertToStr($data, $pos_guanwang + 23, $guanwang);
			}

			// 插入百科(在官网之后)
			$baike = getBaike($wd, $domain);
			$pos_baike = strpos($data, '<div id="robber_guanwang"></div>');
			if($pos_baike){
				$i++;
				$data = insertToStr($data, $pos_baike + 32, $baike);
			}elseif($pos_guanwang){
				$pos_baike = strpos($data, '<div id="robber_tuiguang"></div>');
				$data = insertToStr($data, $pos_baike + 32, $baike);
			}elseif($pos_tuiguang){
				$pos_baike = strpos($data, '<div id="robber_pinpai"></div>');
				$data = insertToStr($data, $pos_baike + 30, $baike);
			}else{
				$pos_baike = strpos($data, '<div id="content_left">');
				$data = insertToStr($data, $pos_baike + 23, $baike);
			}

			// 插入客服(在百科之后)
			$kefu = getKefu($wd, $domain);
			$pos_kefu = strpos($data, '<div id="robber_baike"></div>');
			if($pos_kefu){
				$i++;
				$data = insertToStr($data, $pos_kefu + 29, $kefu);
			}elseif($pos_baike){
				$pos_kefu = strpos($data, '<div id="robber_guanwang"></div>');
				$data = insertToStr($data, $pos_kefu + 32, $kefu);
			}elseif($pos_guanwang){
				$pos_kefu = strpos($data, '<div id="robber_tuiguang"></div>');
				$data = insertToStr($data, $pos_kefu + 32, $kefu);
			}elseif($pos_tuiguang){
				$pos_kefu = strpos($data, '<div id="robber_pinpai"></div>');
				$data = insertToStr($data, $pos_kefu + 30, $kefu);
			}else{
				$pos_kefu = strpos($data, '<div id="content_left">');
				$data = insertToStr($data, $pos_kefu + 23, $kefu);
			}

			// 删除多余的条目
			$removeChild = '
			<script type="text/javascript">
				for (var i=1;i<='.$i.';i++){
					var child = document.getElementById(i);
					child.parentNode.removeChild(child);
				}
			</script>';
			$pos_removeChild = strpos($data, '</body>');
			$data = insertToStr($data, $pos_removeChild, $removeChild);
		}

		return view('robber')->withData($data);
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
	$kefu = getKefu($wd);
	$pos_kefu = strpos($data, '<div id="robber_baike"></div>');
	$data = insertToStr($data, $pos_kefu + 29, $kefu);

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
			return redirect('/admin/users');
		});
		Route::get('/users', 'Admin\UserController@index');
		Route::get('/setUserGroup/{id}', 'Admin\UserController@setUserGroup');
		Route::get('/websites', 'Admin\WebsiteController@index');
	});
});