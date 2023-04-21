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
<meta name="keywords" content="<?php echo $timu; ?>-影视排行榜-百度风云榜-搜狗影视榜">
<title>影视排行榜-百度风云榜-搜狗影视榜-<?php echo $aik['sitename'];?>
</title>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<script>
if (top.location != location) {
document.write("<style>.header,.footer,#more,.sidebar,#homeso img,.action-rewards,.article-wechats{display: none!important}.content{width:100%}::-webkit-scrollbar-thumb{background-color:#fff;height:50px;outline-offset:-2px;outline:2px solid #fff;-webkit-border-radius:4px;border:2px solid #fff}::-webkit-scrollbar-thumb:hover{background-color:#FB4446;height:50px;-webkit-border-radius:4px}::-webkit-scrollbar{width:8px;height:18px}::-webkit-scrollbar-track-piece{background-color:#fff;-webkit-border-radius:0}body,.single-post .content{padding-top: 0px;}</style>");
}
</script>

  <style>
.search-item{margin:0 0 25px}
.search-item .item-title{font-size:medium;line-height:1.2}
.search-item .item-list{color:#545454;line-height:1.4;font-size:13px;word-wrap:break-word}
.search-item .item-bar{color:#00802a;font-size:13px;line-height:1pc}
.search-item .item-bar .download,.search-item .item-bar span{margin-right:10px}
.highlight{color:red;margin-left:0!important}
.bottom-pager{margin:30px 0}
.bottom-pager a,.bottom-pager span{font:13px/1.22 arial,helvetica,clean,sans-serif;border:1px solid #e1e2e3;text-decoration:none;text-align:center;vertical-align:middle;margin:2px;padding:8px 9pt;display:inline-block;color:#1e0fbe}
.bottom-pager span{background-color:#eee;color:#888;font-weight:700}
.bottom-pager a:hover{background:#f2f8ff;border:1px solid #38f}
.bottom-pager a:visited{color:#1e0fbe}
.new{display:inline-block;padding:2px;text-align:center;vertical-align:text-bottom;font-size:9pt;line-height:100%;font-style:normal;color:#fff;overflow:hidden;background-color:#f13f40;position:relative;right:-4px;top:-4px}
.baidu-box,.bdSug_app,.bdsug_copy{display:none}
.bdSug_wpr td{padding-left:5px!important}
.push{height:40px;clear:both}
.res-title{font-size:20px}
.fileDetail{position:relative}
.fileDetail p{color:#444!important;font-size:1pc}
.thumb{position:absolute;top:0;left:25pc;max-width:230px}
.pill󰡤ding:2px 4px;color:#d14;background-color:#f7f7f9;border:1px solid #e1e1e8}
.cpill,.pill{white-space:nowrap}
.cpill{padding-right:9px;padding-left:9px;border-radius:9px;color:#fff;text-shadow:0 -1px 0 rgba(0,0,0,.25);vertical-align:baseline}
.blue-pill{background-color:#3a87ad}
.yellow-pill{background-color:#f89406}
ol{margin:0 0 15px}
ol li{line-height:1.5em;color:#444}
.order{background:#f8f8f8;margin-bottom:0;font-size:14px;margin-bottom:10px}
.order a.active{border-bottom:2px solid #38f;font-weight:700}
.order a.desc{background:url(arrowdown.png) 100% 50% no-repeat}
.order a.asc{background:url(arrowup.png) 100% 50% no-repeat}
.order a:visited{color:#1e0fbe}
.order a{text-decoration:none;padding:0 15px 0 8px;margin-right:6px;line-height:30px;display:inline-block}
.order a:hover{border-bottom:2px solid #38f}
.single-strong{color:#606060;font-size:14px;font-weight:700;border-left:3px solid #ff5c5c;padding-left:10px;display:block;line-height:2pc;margin:10px 0}
#wall,.order{padding:0;overflow:hidden}
.search-item {
    margin: 0px 0px 25px 0px;
    border-bottom: 1px solid #eee;
    padding-bottom: 22px;
}
.fileDetail p:nth-child(1){
	display: none;
}
.fileDetail p a{
word-wrap: break-word;
}
#wall ol{
margin: 0;
    padding: 0;
}
#wall ol li{
	line-height: 2.5em;
}
#homeso img{
	width:250px;
}
@media only screen and (max-width:720px){
.search-item .item-bar {
    line-height: 24px;
}
.sidebar{
	display:none
}
#resultList{
	width:100% !important
}
}

#homeso{margin:120px 0}
.pcadd{display:block}
.madd{display:none}
.homesoin{color:#999;border:1px solid #eee;width:500px;padding:4px 8px;border-right:none;border-radius:2px 0 0 2px}
.homesobtn,.homesoin{height:50px;font-size:14px;outline:0}
.homesobtn{color:#fff;background-color:#ff6651;width:75pt;border:none;padding:4px 10px;border-radius:0 2px 2px 0;opacity:.9}



#resultList{
	width: 500px;
    overflow: hidden;
	float: left;
}

.sidebar {
float: right;}

@media only screen and (max-width:414px){
.pcadd{display:none}
.madd{display:block}
#homeso{margin:70px 0}
.homesoin{width:260px}
.jie{padding:0 18px;font-size:10px}
}
@media only screen and (max-width:376px){
	#homeso{margin:60px 0}
.homesoin{width:180px;height:44px}
.homesobtn{height:44px;width:5pc}
.footer{font-size:10px}
}
@media only screen and (max-width:360px){#homeso{margin:50px 0}
.homesoin{width:180px;height:40px}
.homesobtn{height:40px;width:5pc}
.footer{font-size:10px}
}


.page-ul{text-align:center;margin:24px 0;clear:both}.page-ul li{margin:0 4px;width:36px;height:36px;line-height:36px;display:inline-block;cursor:pointer}.page-ul li{color:#FF6651;background:#fff;transition:background ease .4s;-webkit-transition:background ease .4s;-moz-transition:background ease .4s;-o-transition:background ease .4s;-ms-transition:background ease .4s}.page-ul a:hover{background-color:#FF6651;color:#fff;border-radius:50%}.page-ul .current{background-color:#FF6651;color:#fff}#text-indent:hover{-webkit-animation:text-indent 1s ease 0s alternate none infinite}#text-indent:hover{-moz-animation:text-indent 1s ease 0s alternate none infinite}#text-indent:hover{animation:text-indent 1s ease 0s alternate none infinite}@-webkit-keyframes text-indent{from{text-indent:0}50%{text-indent:20px}to{text-indent:-20px}}@-moz-keyframes text-indent{from{text-indent:0}50%{text-indent:20px}to{text-indent:-20px}}@keyframes text-indent{from{text-indent:0}50%{text-indent:20px}to{text-indent:-20px}}.fenlei{margin-top:10px}


.wprm{
	padding:0;
	margin:0 auto;
	border-top: 1px solid #eee;
}
.wprm li{
    list-style: none;
    text-align: center;
    float: left;
    border: 1px solid #D8D8D8;
    margin: 6px;
    padding: 2px 6px;
    border-radius: 2px;
    font-size: 13px;
}
</style>
<body class="page-template page-template-pages page-template-posts-taoke page-template-pagesposts-taoke-php page page-id-65">
<?php  include 'header.php';?>
<section class="container">
<div id="homeso">

<form method="get" id="homeso" style="text-align: center;float: none" action="seacher.php?sousuo=" >
<img src="images/sologo.png"><br/><br/>
<input tabindex="2" class="homesoin" id="sos" name="sousuo" type="text" placeholder="输入片名关键词" value="">
<button id="button" tabindex="3" class="homesobtn" type="submit">搜索</button>
</form>

</div>

<div class="single-strong">最新推荐<span class="chak"><a href="cxlisth.php">查看更多</a></span></div>
<div class="b-listtab-main">
<div class="s-tab-main">
<ul class="list g-clear">
<?php include './data/zwcx.php';?>
</ul>
</div>
</div>
</section>

<div class="single-strong">热门电影搜索</div><ul class="wprm"><?php
	$queryURL = "http://top.baidu.com/buzz?b=26&c=1&fr=topcategory_c1";
	$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";
	$header = array("Accept-Language: zh-cn", "Connection: Keep-Alive", "Cache-Control: no-cache");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_REFERER, $queryURL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_URL, $queryURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
	$result = curl_exec($ch);
	$result = mb_convert_encoding($result, "utf-8", "gb2312");
	$result = str_replace("/ct/", "/play?make=dongman&id=", $result);
	$pattern = "#<a class=\"list-title\" target=\"_blank\" href=\"(.*?)\" href_top=\"(.*?)\">(.*?)</a>#";
	preg_match_all($pattern, $result, $matches);
	$xh = 0;
	while ($xh < 50) {
?><li><a target="_blank" href="seacher.php?sousuo=<?php echo $matches[3][$xh];?>"><?php echo $matches[3][$xh];?></a></li><?php
		$xh = $xh + 1;
	}
?></ul>


</div>
<div class="single-strong">热门电视剧搜索</div><ul class="wprm"><?php
	$queryURL = "http://top.baidu.com/buzz?b=4&c=2&fr=topcategory_c2";
	$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";
	$header = array("Accept-Language: zh-cn", "Connection: Keep-Alive", "Cache-Control: no-cache");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_REFERER, $queryURL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_URL, $queryURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
	$result = curl_exec($ch);
	$result = mb_convert_encoding($result, "utf-8", "gb2312");
	$result = str_replace("/ct/", "/play?make=dongman&id=", $result);
	$pattern = "#<a class=\"list-title\" target=\"_blank\" href=\"(.*?)\" href_top=\"(.*?)\">(.*?)</a>#";
	preg_match_all($pattern, $result, $matches);
	$xh = 0;
	while ($xh < 50) {
?><li><a target="_blank" href="seacher.php?sousuo=<?php echo $matches[3][$xh];?>"><?php echo $matches[3][$xh];?></a></li><?php
		$xh = $xh + 1;
	}
?></ul>



</div>
<div class="single-strong">热门综艺搜索</div><ul class="wprm"><?php
	$queryURL = "http://top.baidu.com/buzz?b=19&c=3&fr=topcategory_c3";
	$useragent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)";
	$header = array("Accept-Language: zh-cn", "Connection: Keep-Alive", "Cache-Control: no-cache");
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_REFERER, $queryURL);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
	curl_setopt($ch, CURLOPT_URL, $queryURL);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 6);
	$result = curl_exec($ch);
	$result = mb_convert_encoding($result, "utf-8", "gb2312");
	$result = str_replace("/ct/", "/play?make=dongman&id=", $result);
	$pattern = "#<a class=\"list-title\" target=\"_blank\" href=\"(.*?)\" href_top=\"(.*?)\">(.*?)</a>#";
	preg_match_all($pattern, $result, $matches);
	$xh = 0;
	while ($xh < 50) {
?><li><a target="_blank" href="seacher.php?sousuo=<?php echo $matches[3][$xh];?>"><?php echo $matches[3][$xh];?></a></li><?php
		$xh = $xh + 1;
	}
?></ul>





</div>








<?php  include 'footer.php';?>
</body>
</html>
