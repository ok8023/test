<?php
include ('./inc/aik.config.php');
$link=$aik['pcdomain'];
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
<title><?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/index.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="<?php echo $aik['keywords'];?>">
<meta name="description" content="<?php echo $aik['description'];?>">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body class="home blog">
<?php  include 'header.php';?>
<div id="homeso">
<form method="get" id="soform" style="text-align: center;float: none" action="<?php echo $link;?>seacher.php">
<?php echo $aik['logo_ss'];?><br><br>
<input tabindex="2" class="homesoin" id="sos" name="sousuo" type="text" placeholder="输入你要观看的视频名称或视频网址" value="">
<button id="button" tabindex="3" class="homesobtn" type="submit">搜索</button>
</form>
<script>
	var a = document.getElementById('sos');
	var btn = document.getElementById('button');
btn.onclick = function(){
 var reg = /^((https|http|ftp|rtsp|mms)?:\/\/)[^\s]+/;
 if(!reg.test(a.value)){
	 if(!a.value){
		 alert('不能为空');
	 }else{
	 }
 }
 else{
var url = '<?php echo $link;?>splay.php?play='+a.value;
window.location.href=url;
 return false;
 }
}
</script>
</div>
<section class="container">
<div class="single-strong">电影尝鲜<span class="chak"><a href="cxlisth.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear" id="dycx">
	 <div id="loading">
		<div class="k-ball7a" ></div>
		<div class="k-ball7b" ></div>
		<div class="k-ball7c" ></div>
		<div class="k-ball7d" ></div>
	</div> 
</ul>
</div>
</div>
<script type="text/javascript">
$(document).ready(function(){ 
$.ajax({
 type:"POST",
 url:"./data/zwcx.php",
 data:"",
 success:function(data){
  $("#dycx").html(data);
 }
})
});
</script>
<div class="single-strong">精品推荐<span class="chak"><a href="../yhq.php?r=l&u=1">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/yhq.php';?>
</ul>
</div>
</div>

<div class="single-strong">最新热门电影推荐<span class="chak"><a href="./movieh.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/topdyjx.php';?>
</ul>
</div>
</div>


<div class="single-strong">最新热门电视剧推荐<span class="chak"><a href="./tvh.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/tvjx.php';?>
</ul>
</div>
</div>

<div class="single-strong">最新热门综艺推荐<span class="chak"><a href="./zongyih.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/zydy.php';?>
</ul>
</div>
</div>

<div class="single-strong">最新热门动漫推荐<span class="chak"><a href="./dongmanh.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/dmdy.php';?>
</ul>
</div>
</div>
</section>
<?php  include 'footer.php';?>
</body>
</html>
