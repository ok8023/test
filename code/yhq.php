<?php
error_reporting(0);
include ('./inc/aik.config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/yhq.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/index.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="<?php echo $timu; ?>-优惠券免费领！不领优惠券就网购！你吃大亏了">
<title>优惠券免费领！不领优惠券就网购！你吃大亏了-<?php echo $aik['sitename'];?>
</title>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<script>
if (top.location != location) {
document.write("<style>.header,.footer,#more,.sidebar,#homeso img,.action-rewards,.article-wechats{display: none!important}.content{width:100%}::-webkit-scrollbar-thumb{background-color:#fff;height:50px;outline-offset:-2px;outline:2px solid #fff;-webkit-border-radius:4px;border:2px solid #fff}::-webkit-scrollbar-thumb:hover{background-color:#FB4446;height:50px;-webkit-border-radius:4px}::-webkit-scrollbar{width:8px;height:18px}::-webkit-scrollbar-track-piece{background-color:#fff;-webkit-border-radius:0}body,.single-post .content{padding-top: 0px;}</style>");
}
</script>
<body class="page-template page-template-pages page-template-posts-taoke page-template-pagesposts-taoke-php page page-id-65">
<?php  include 'header.php';?>
<section class="container">
<div id="homeso">

<form method="get" id="homeso" style="text-align: center;float: none" action="<?php echo $aik['dtk_ad']?>index.php?r=l&kw=" >
<img src="images/yhq.png"><br/><br/>
<input tabindex="2" class="homesoin" id="sos" name="kw" type="text" placeholder="输入你要搜索的宝贝名称" value="">
<input type="hidden" name="r" value="l">
<button id="button" tabindex="3" class="homesobtn" type="submit">优惠券搜索</button>
</form>
<script>
	var a = document.getElementById('sos');
	var btn = document.getElementById('button');
btn.onclick = function(){
if(!a.value){
	alert('不能为空');
	return false;    
	 }
}
</script>
</div>

<div class="single-strong">精品推荐<span class="chak"><a href="<?php echo $aik['dtk_ad']?>">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/yhq.php';?>
</ul>
</div>
</div>
</section>
<?php  include 'footer.php';?>
</body>
</html>