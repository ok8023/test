<?php
include ('./inc/aik.config.php');
include ('./data/init.php');
if(isset($_GET['pageno'])){$page=$_GET['pageno'];}else{$page=1;}
if(empty($_GET['m'])){$html='https://www.360kan.com/zongyi/list?cat=all&act=all&area=all&rank=createtime&pageno=1';
}else{ 
$html='https://www.360kan.com/zongyi/'.$_GET['m'].'&pageno='.$page;
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
<title>综艺列表-<?php echo $aik['title'];?></title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/movie.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="综艺排行">
<meta name="description" content="<?php echo $aik['title'];?>-综艺排行">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body>
<?php  include 'header.php';?>
<section class="container"><div class="fenlei">
<div class="b-listfilter" style="padding: 0px;">
<dl class="b-listfilter-item js-listfilter" style="padding-left: 0px;height:auto;padding-right:0px;">
<dd class="item g-clear js-listfilter-content" style="margin: 0;">
<?php
$response=curl_get($html);
$response = strstr($response, '<dt class="type">类型:</dt>') ;
$response = strstr($response, '</dd>',TRUE) ;
$response = str_replace('<dt class="type">类型:</dt>',"",$response);
$response = str_replace('<b class="on">','<a class="active">',$response);
$response = str_replace('</b>','</a>',$response);
$response = str_replace('<dd class="item g-clear js-filter-content">',"",$response);
$response = str_replace('https://www.360kan.com/zongyi/list?act=all&area=all&cat=','zongyi.php?m=list.php?cat=',$response);
echo $response;
?>
</dd>
</dl>
</div>
</div>
<div class="m-g">
<div class="b-listtab-main">
<div class="s-tab-main">
                    <ul class="list g-clear">	
 <?php
$rurl=curl_get($html);
$vname='#<p class="title g-clear">
                                    <span class="s1">(.*?)</span>
                                </p>#';//取出电影的名字
$vlist='#<a class="js-tongjic" href="(.*?)"#';//取出电影的详情列表
$vstar='#<p class="star">(.*?)</p>#';//取出电影的主演
$vimg='#<div class="cover g-playicon">
                                <img src="(.*?)">#';//取出电影的封面
$bflist='#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';//取电影播放地址
$jishu='#<span class="hint">(.*?)</span> #';
$yuming='http://www.360kan.com';
preg_match_all($vname, $rurl,$xarr);
preg_match_all($vlist, $rurl,$xarr1);
preg_match_all($vstar, $rurl,$xarr2);
preg_match_all($vimg, $rurl,$xarr3);
preg_match_all($bflist, $rurl,$xarr4);
preg_match_all($jishu, $rurl,$xarr5);
$xname=$xarr[1];//名字
$xlist=$xarr1[1];//360看的地址
$xstar=$xarr2[1];//主演
$ximg=$xarr3[1];//封面图
$xbflist=$xarr4[1];//暂时不用
$xjishu=$xarr5[1];//剧集
foreach ($xname as $key=>$xvau){
  $tok=base64_encode($xlist[$key]);
    $ccb="./play.php?play=".$tok;
    echo "<li class='item'>
    <a class='js-tongjic' href='$ccb' title='$xvau' target='_blank'>
<div class='cover g-playicon'>
<img src='$ximg[$key]' alt='$xvau'/>
  <span class='hint'>$xjishu[$key]</span> </div>
  <div class='detail'>
 <p class='title g-clear'>
 <span class='s1'>$xvau</span>
   <span class='s2'></span>
                                </p>
                                <p class='star'>$xstar[$key]</p>
 </div>
 </a>
</li>";
}
//print_r($rurl);
?>

</li>
  </ul>
      </div>


    </div>
</div> 
     <?php
$rurl=curl_get($html);
$rurl = strstr($rurl, "<div monitor-desc='分页'") ;
$rurl = strstr($rurl, '</div>',TRUE) ;
$rurl = str_replace('https://www.360kan.com/zongyi/',"zongyi.php?m=",$rurl);
echo $rurl;
?> </div>
</div> 
<div class="asst asst-list-footer"><?php echo $aik['zongyi_ad'];?></div></section>
<?php  include 'footer.php';?>
</body></html><?php   
/**$feng=$_GET['m'];
$newstr = substr($feng,0,strlen($feng)-1); 
$newstr1=str_replace("&","%26","$newstr");
//echo $newstr1;
$hello = explode('=',$feng); 
$hello1=$hello[2]+1;
$boss="http://localhost/jiexi/demo.php?u=".$newstr1.$hello1;
echo $boss;**/
?>
