<?php 
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
include ('./data/init.php');
$url='http://www.360kan.com/dianying/list';
$info = curl_get($url);
define('360', 'www.360kan.com');//域名
$yuming="http://www.360kan.com";
$vname='#<span class="s1">(.*?)</span>#';//取出电影的名字
$fname='#<span class="s2">(.*?)</span>#';//取出电影的评分
$nname='#<span class="hint">(.*?)</span>#';//取出电影的年份
$vlist='#<a class="js-tongjic" href="(.*?)">#';//取出电影的详情列表
$vstar='# <p class="star">(.*?)</p>#';//取出电影的主演
$vimg='#<div class="cover g-playicon">
                                <img src="(.*?)">#';
$bflist='#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';
$array = array();

preg_match_all($vname, $info,$namearr);
preg_match_all($vlist, $info,$listarr);
preg_match_all($vstar, $info,$stararr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($fname, $info,$fnamearr);
preg_match_all($nname, $info,$nnamearr);
       for($i =0;$i<12;$i++){   
	   $gul=$listarr[1][$i];//取出播放链接
           $guq=$listarr[1][$i];
           $_GET['id']=$gul;
           //echo $guq;
           $zimg=$imgarr[1][$i];//取出图片链接
           $zname=$namearr[1][$i];//取出影片名字
		   $fname=$fnamearr[1][$i];//取出影片评分
		   $nname=$nnamearr[1][$i];//取出影片年份
           $zstar=$stararr[1][$i];
           $tok=base64_encode($gul);
           //echo $zname;
           //echo $gul;//取出播放链接
		   $player='play.php?play='.$tok;
           echo "
		    <li  class='item'><a class='js-tongjic' href='$player' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='pay'>推荐</span>       <span class='hint'>$nname</span>
         </div>
         <div class='detail'>
          <p class='title g-clear'>
		    <span class='s1'>$zname</span>
			<span class='s2'>$fname</span></p>
           <p class='star'>$zstar</p>
          </div>
         </a></li> ";
       }
       ?>