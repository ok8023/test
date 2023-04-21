<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
	$_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
	exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="../static/admin/layui/css/layui.css" />
	<link rel="stylesheet" type="text/css" href="../static/admin/css/admin.css" />
	<link rel="stylesheet" href="//at.alicdn.com/t/font_1507359_tggqsm0rkj.css">
</head>

<body>
	<div class="main-layout" id='main-layout'>
		<div class="main-layout-side">
			<div class="m-logo">
			</div>
			<ul class="layui-nav layui-nav-tree" lay-filter="leftNav">
				<li class="layui-nav-item">
					<a href="javascript:;" data-url="ulist.php" data-id='1' data-text="用户管理"><i class="iconfont iconpingtaiguanliyonghuguanli"></i>用户管理</a>
				</li>
				<li class="layui-nav-item">
					<a href="javascript:;" data-url="urllist.php" data-id='2' data-text="网址管理"><i class="iconfont iconlianjie"></i>网址管理</a>
				</li>
				<li class="layui-nav-item">
					<a href="javascript:;" data-url="safelist.php" data-id='3' data-text="监控管理"><i class="iconfont iconyulan"></i>监控管理</a>
				</li>
				<li class="layui-nav-item">
					<a href="javascript:;" data-url="set.php" data-id='5' data-text="系统设置"><i class="iconfont iconshezhi"></i>系统设置</a>
				</li>
			</ul>
		</div>
		<div class="main-layout-container">
			<div class="main-layout-header">
				<div class="menu-btn" id="hideBtn">
					<a href="javascript:;">
						<span class="iconfont">&#xe60e;</span>
					</a>
				</div>
				<ul class="layui-nav" lay-filter="rightNav">
					<li class="layui-nav-item"><a href="javascript:;" data-url="set.php" data-id='5' data-text="系统设置"><i class="iconfont iconshezhi"></i></a></li>
					<li class="layui-nav-item">
						<a href="javascript:;" data-url="set.php?mod=account" data-id='6' data-text="账号设置">admin</a>
					</li>
					<li class="layui-nav-item"><a href="./login.php?logout">退出</a></li>
				</ul>
			</div>
			<div class="main-layout-body">
				<div class="layui-tab layui-tab-brief main-layout-tab" lay-filter="tab" lay-allowClose="true">
					<ul class="layui-tab-title">
						<li class="layui-this welcome">后台主页</li>
					</ul>
					<div class="layui-tab-content">
						<div class="layui-tab-item layui-show" style="background: #f5f5f5;">
							<iframe src="welcome.php" width="100%" height="100%" name="iframe" scrolling="auto" class="iframe" framborder="0"></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="main-mask">

		</div>
	</div>
	<script type="text/javascript">
		var scope = {
			link: './welcome.php'
		}
	</script>
	<script src="../static/admin/layui/layui.js" type="text/javascript" charset="utf-8"></script>
	<script src="../static/admin/js/common.js" type="text/javascript" charset="utf-8"></script>
	<script src="../static/admin/js/main.js" type="text/javascript" charset="utf-8"></script>

</body>

</html>