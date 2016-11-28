<!DOCTYPE html>
<html>
<head>
	<title>极盗者 - 更简易的搜索服务 - Robber.site</title>
	<link href="//cdn.bootcss.com/fullPage.js/2.8.8/jquery.fullPage.min.css" rel="stylesheet">
	<script src="//cdn.bootcss.com/jquery/3.1.1/jquery.min.js"></script>
	<script src="//cdn.bootcss.com/fullPage.js/2.8.8/jquery.fullPage.min.js"></script>
	<style type="text/css">
		.container {
		    text-align: center;
		    color: #333;
		    font-size: 14px;
		    margin: 15px;
		}
		a{
			text-decoration: none;
			color: #2196f3;
		}
		a:hover{
		  color: #0a6ebd;
		  text-decoration: underline;
		}
		h1{
			font-weight: 500;
			font-size: 72px;
			margin: 0;
			color: #444;
		}
		h2{
			font-weight: 500;
			font-size: 36px;
			margin: 0;
			color: #000;
		}
		img{
			max-width: 100%;
			box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
		}
		.fp-auto-height a{
			color: #666;
			font-size: 14px;
			margin: 0 5px;
		}
		.fp-auto-height a:hover{
			color: #333;
		}
		#fp-nav ul li a span, .fp-slidesNav ul li a span{
			background-color: #fff;
			border: solid 1px #2196f3;
		}
		#fp-nav ul li .fp-tooltip{
			color: #2196f3;
		}
		.fp-tooltip{
			display: block;
		}
		table{
            margin: 0 auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        table td, table th{
            padding: 15px;
            background-color: #fff;
            border: solid 1px #e7e7e7;
        }
        img{
        	max-width: 300px;
        	width: 100%;
        }
        p{
        	line-height: 1.8;
        	max-width: 500px;
        	margin: 15px auto;
        	color: #999;
        }
	</style>
</head>
<body>
	<div id="fullpage">
	    <div class="section">
	    	<div class="container">
		    	<h1>极盗者</h1>
	            <p>君子不为盗，贤人不为窃。《庄子·山水》</p>
	            @if (Auth::guard()->check())
	            	<p><a href="{{ url('/home') }}">管理中心</a> 或 <a href="{{ url('/logout') }}">登出</a></p>
	            @else
	            	<p><a href="{{ url('/login') }}">登录</a> 或 <a href="{{ url('register') }}">注册</a></p>
	            @endif
            </div>
	    </div>
	    <div class="section">
	    	<div class="container">
	            <h2>可定制的搜索结果</h2>
	            <p>为推广者提供更高转化可能</p>
	            <p><img src="/images/baidu-pp.png" style=""></p>
	   			<p>搜索结果不限于品牌推广、官网、百科、客服电话、图片展示等等。</p>
            </div>
	    </div>
	    <div class="section">
	        <div class="container">
	            <h2>覆盖全网引擎</h2>
	            <p>降低白帽推广难度</p>
	            <p><img src="/images/baidu-pp.png" style=""><img src="/images/baidu-pp.png" style=""></p>
	            <p>关键字转化即为准客户，不必担心客户选择和流失，变现能力成倍提升。</p>
        	</div>
	    </div>
	    <div class="section">
	    	<div class="container">
	            <h2>极致用户体验</h2>
	            <p>简洁易用的后台操作</p>
	            <p><img src="/images/baidu-pp.png" style=""></p>
	            <p>SEO推广人员、站长、企业网络营销人员等等都可以轻松操作。</p>
        	</div>
	    </div>
	    <!--<div class="section">
	    	<div class="container">
	            <h2>服务价格</h2>
	            <p>便宜的不像收费服务</p>
	            <table>
		            <tr>
		                <th>购买方式</th>
		                <th>价格(元)</th>
		                <th>站点数</th>
		                <th>备注</th>
		            </tr>
		            <tr>
		                <td>按月</td>
		                <td>350 元</td>
		                <td>1</td>
		                <td>服务时间为30天</td>
		            </tr>
		            <tr>
		                <td>按年</td>
		                <td>3000 元</td>
		                <td>1</td>
		                <td>服务时间为365天</td>
		            </tr>
		            <tr>
		                <td>代理</td>
		                <td>30000 元</td>
		                <td>无限制</td>
		                <td>无限制</td>
		            </tr>
		        </table>
	            <p>多种购买方式，满足不同需求。</p> 
        	</div>
	    </div>
	    <div class="section">
	    	<div class="container">
	            <h2>支付</h2>
	            <p>所有用户可拥有多个站点，且按单个站点收费(<b>代理无限制</b>)，付款之前请联系扣扣：605159011，以便确认用户名并开通服务，目前只接受<a href="">支付宝二维码</a>和<a href="">微信二维码</a>这两种付款方式。</p>
        	</div>
	    </div>
	    <div class="section">
	    	<div class="container">
	            <h2>支付 - 微信</h2>
	            <p>付款之前请联系扣扣：605159011，以便确认用户名并开通服务。</p>
	            <p><img src="/images/pay-weixin.png"></p>
        	</div>
	    </div>
	    <div class="section">
	    	<div class="container">
	            <h2>支付 - 支付宝</h2>
	            <p>付款之前请联系扣扣：605159011，以便确认用户名并开通服务。</p>
	            <p><img src="/images/pay-zhifubao.jpg"></p>
        	</div>
	    </div>-->
	    <div class="section fp-auto-height">
            <div class="container">
	            <p>
	                <a href="">服务价格</a>
	                <a href="">客户案列</a>
	                <a href="">申请代理</a>
	                <a href="">网站建设</a>
	                <a href="">联系我们</a>
	            </p>
        	</div>
	    </div>
	</div>
	<script type="text/javascript">
		$(function(){
		    $('#fullpage').fullpage({
		        'verticalCentered': true,
		        'css3': true,
		        'sectionsColor': ['#fff', '#f8f8f8', '#fff', '#f8f8f8', '#fff'],
		        'anchors': ['page1', 'page2', 'page3', 'page4', 'page5'],
		        'navigation': true,
		        'navigationColor': '#2196f3',
		        'navigationPosition': 'right',
		        'navigationTooltips': ['极盗者', '定制', '全网', '体验', '极盗者'],
		        // 'loopBottom': true,
		    })
		})
	</script>
</body>
</html>