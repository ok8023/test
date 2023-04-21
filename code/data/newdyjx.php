<?php
//以下代码为PHP核心代码 如若不明 请勿修改
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
include './inc/config.php';

$info=file_get_contents('http://www.360kan.com/dianying/list.php?cat=all&year=all&area=all&act=all&rank=createtime');
//print_r($info);
$vname='#<span class="s1">(.*?)</span>#';//取出电影的名字
$vlist='#<a class="js-tongjic" href="(.*?)">#';//链接
$vstar='#<p class="star">(.*?)</p>#';//取出电影的主演

$vimg='#<div class="cover g-playicon">
                                <img src="(.*?)">#';//取出电影的封面
$nname='#<span class="hint">(.*?)</span>#';
$fname='#<span class="s2">(.*?)</span>#';
$array = array();
//电影的信息加入数组 开始
preg_match_all($vname, $info,$namearr);
preg_match_all($vlist, $info,$listarr);
preg_match_all($vstar, $info,$stararr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($nname, $info,$nnamearr);
preg_match_all($fname, $info,$fnamearr);
       for($i =0;$i<12;$i++){   
	       $gul=$listarr[1][$i];//取出播放链接
           $zimg=$imgarr[1][$i];//取出图片链接
           $zname=$namearr[1][$i];//取出影片名字
		   $fname=$fnamearr[1][$i];//取出影片评分
		   $nname=$nnamearr[1][$i];//取出影片年份
           $zstar=$stararr[1][$i];
		   $player='play.php?play='.$gul;
           echo "
		    <li  class='item'><a class='js-tongjic' href='$player' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' /> <span class='hint'>$nname</span>
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