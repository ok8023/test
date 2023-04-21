<?php
error_reporting(0);
header('Content-Type:text/html;charset=UTF-8');
include ('./inc/aik.config.php');
include ('./inc/init.php');

$curl = $aik['zhanwai'];
if (empty($_GET['cid'])) {
    $cxurl = $curl;
    $x=$_GET['page'];
    $url = $cxurl."?p=".$x;
} else {
    $cxurl = $curl."?cid=".$_GET["cid"];
    $x=$_GET['page'];
    $y=$_GET['cid'];
    $url = $curl."?p=".$x."&cid=".$y;
}
if(empty($_GET['page'])){
    $_GET['page']='1';
}
$list=json_decode(file_get_contents($cxurl),true);
$data=json_decode(file_get_contents($url),true);
$recordcount = $data['page']['recordcount'];
$pagesize = $data['page']['pagesize'];
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
<title>看电影-最新好看的最新电影电视剧-<?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/movie.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="看电影-全网最新好看的最新电影">
<meta name="description" content="<?php echo $aik['title'];?>-看电影-，智卓星网最新好看的最新电影">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body>
<?php  include 'header.php';?>
<section class="container"><div class="fenlei">
<div class="b-listfilter" style="padding: 0px;">
<style>
#noall{
    background-color: #ff6651;
    color: #fff;
}
#pagemax {color: #ff6651;     padding:0px;}
</style>
<dl class="b-listfilter-item js-listfilter" style="padding-left: 0px;height:auto;padding-right:0px;">
<dd class="item g-clear js-listfilter-content" style="margin: 0;">

<a href="cxlist.php" >全部</a>
<?php  
$num=count($list['list']);
if ($num>24){$num=24;}
for($i=0; $i<$num; $i++){
    if (mb_strpos($list['list'][$i]['list_name'], '福利') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '韩国主播VIP视频') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '电影') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '连续剧') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '电影片') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '伦理片') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '伦理') === false) { 
    if (mb_strpos($list['list'][$i]['list_name'], '写真视频') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '美女视频') === false) {
    if (mb_strpos($list['list'][$i]['list_name'], '美女写真') === false) {
?>
    <a href="cxlist.php?page=1&cid=<?php echo $list['list'][$i]['list_id'];?>"><?php echo $list['list'][$i]['list_name'];?></a><?php }}}}}}}}}}}?>   


</dd>
</dl>
</div>
</div>
<div class="m-g">
<div class="b-listtab-main">
<div>
<div>
<div class="s-tab-main">
                    <ul class="list g-clear">
<?php
    for($i=0; $i<18; $i++){
    if (mb_strpos($data['data'][$i]['list_name'], '美女写真') === false) {
    if (mb_strpos($data['data'][$i]['list_name'], '伦理片') === false) {
    if (mb_strpos($data['data'][$i]['list_name'], '福利') === false) {
    if (mb_strpos($data['data'][$i]['list_name'], '伦理') === false) {
            $player="./mplay.php?id=".$data['data'][$i]['vod_id'];
    ?>
<li class="item">
    <a class="js-tongjic" href="<?php echo $player;?>" title="<?php echo $data['data'][$i]['vod_name'];?>" target="_blank">
<div class="cover g-playicon">
<img src="<?php echo $data['data'][$i]['vod_pic'];?>" alt="<?php echo $data['data'][$i]['vod_name'];?>">
</div>
<div class="detail">
<p class="title g-clear">
 <span class="s1"><?php echo $data['data'][$i]['vod_name'];?></span>
 <span class="s2"></span></p>
<p class="star">主演：<?php echo $star=$data['data'][$i]['vod_actor']=''?'未知':$data['data'][$i]['vod_actor'];?></p>
 </div>
</a>
</li>
        <?php }}}}}?> 
     </ul>
                </div>


    </div>
</div> 

 <div class="paging">
<?php
if(!empty($_GET['cid'])){
    $cid=$_GET['cid'];
    $c="&cid=".$cid;}
    else{$c="";}
if($_GET['page'] != 1){
     echo '<a href="cxlist.php?page=1'.$c.'">首页</a>';
     echo '<a href="cxlist.php?page=' . ($_GET['page']-1) .$c.'"><</a>';
     } else {
echo '<a href="cxlist.php?page=1'.$c.'">首页</a>';
}
if($_GET['page'] == 1){
    echo '';
}else
echo '<a href="cxlist.php?page='.($_GET['page']-1).$c.'">'.($_GET['page']-1).'</a>';
echo '<a href="cxlist.php?page='.$_GET['page'].$c.'" class="active">'.$_GET['page'].'</a>';
if($_GET['page'] == 200){
    echo '';
}else
echo '<a href="cxlist.php?page='.($_GET['page']+1).$c.'">'.($_GET['page']+1).'</a>';

if($_GET['page'] < 200){
     echo '<a href="cxlist.php?page=' . ($_GET['page']+1) .$c.'">></a>';
     echo '<a href="cxlist.php?page=100'.$c.'">尾页</a>';
     } else {
echo '<a class="disabled">尾页</a>';
}    
?>      
</div>
</div></div>
<div class="asst asst-list-footer"><?php echo $aik['movie_ad'];?></div></section>
<?php  include 'footer.php';?>
</body></html>
