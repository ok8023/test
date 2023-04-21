<?php
error_reporting(0);
include ('./inc/aik.config.php');
include ('./data/init.php');
?>
<?php
/**
 * template name: 搜索结果页面
 */

if (!$_GET['sousuo']) {
	$tiao=$aik['pcdomain'];
   echo "<meta http-equiv=refresh content='0; url=$tiao'>";
}

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
<title>《<?php echo $_GET['sousuo']?>》-搜索结果-<?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/seacher.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="《<?php echo $_GET['sousuo']?>》搜索结果">
<meta name="description" content="<?php echo $aik['title'];?>-《<?php echo $_GET['sousuo']?>》搜索结果">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
<style>
.w-mfigure{
    width: 18%;min-width:150px;
    height: 180px;
	float:left;
    margin-left: 10px;
    margin-top: 0px;
display: inline-block;}
h4{font-size:12px}
</style>
</head>
<?php  include 'header.php';?>
<section class="container">
<div style="text-align: center;padding: 10px 0;color: #FF7562;font-size: 12px;">温馨提示:请点击搜索结果的标题或封面图进行观看</div>
<strong class="single-strong">全网搜索(来自爱奇艺/优酷/腾讯/乐视等)</strong>
<div class="zhan">
<div class="video-list">
<ul class="mvul" id="searchall">

<?php
$url = 'https://video.360kan.com/v?ie=utf-8&src=360sou_home&q=' .$_GET['sousuo']. '&_re=0';
$ch = curl_init($url); //初始化
curl_setopt($ch, CURLOPT_HEADER, 0); // 不返回header部分
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // 返回字符串，而非直接输出
curl_setopt($ch, CURLOPT_USERAGENT, "Dalvik/1.6.0 (Linux; U; Android 4.1.4; DROID RAZR HD Build/9.8.1Q-62_VQW_MR-2)");
curl_setopt($ch, CURLOPT_REFERER, "-");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // https请求 不验证证书和hosts
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
$seach = curl_exec($ch);
$title='#js-playicon" title="(.*?)"#';
$link='#<a href="http://www.360kan.com(.*?)" class="g-playicon js-playicon#';
$img='#<img src="(.*?)" alt="(.*?)"#';
$title_result = array('name'=>1,);
$link_result = array('link'=>1,'panduan'=>3, );
$img_result = array('img'=>1,);
preg_match_all($title, $seach,$titlearr);//名字
preg_match_all($link, $seach,$linkarr);//链接
preg_match_all($img, $seach,$imgarr);//图片       
    foreach($titlearr[$title_result['name']] as $k=>$c){
        $results[$k]['name'] = $titlearr[$title_result['name']][$k];
        $results[$k]['link'] = $linkarr[$link_result['link']][$k];
        $results[$k]['img'] = $imgarr[$img_result['img']][$k];
}
foreach($results as $k=>$c){ 
$tok=base64_encode($c['link']);
$player='play.php?play='.$tok;
?>
<li><a href="<?php echo $player;?>"><img src="<?php echo $c['img']?>" /><span><?php echo $c['name']?></span></a></li>
<?php } ?>

</ul>
</div></div>

<div style="clear: both;"></div>
<strong class="single-strong">尝鲜搜索结果</strong>
<div class="zhan">
<div class="video-list">
<ul class="mvul" id="searchall">
    <?php 
$zyso = file_get_contents(''.$aik['zhanwai'].'?wd='.$_GET['sousuo'].''); 
$data = json_decode($zyso, true);
foreach($data["data"] as $i =>$name){
 $player="./mplay.php?id=".$data['data'][$i]['vod_id'];   
?>
<li><a href="<?php echo $player?>"><img src="<?php echo $data["data"][$i]["vod_pic"]; ?>" /><span><?php echo $data["data"][$i]["vod_name"]; ?></span></a></li>
    <?php }  ?>
</ul>
</div></div>

<div style="clear: both;"></div>

</section>
<?php  include 'footer.php';?>