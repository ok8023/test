<?php
//以下代码为PHP核心代码 如若不明 请勿修改
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$info=file_get_contents('http://blog.woaik.com/');
//print_r($info);
$vname='#<a href="http://blog.woaik.com/(.*?)" class="zoom" rel="bookmark" target="_blank" title="(.*?)">
#';//取出电影的名字
$fname='#rel="category tag">(.*?)</a></span>#';
$vimg='#<img src="(.*?)" alt="(.*?)" />                                                      <div class="zoomOverlay"></div>#';
$array = array();
preg_match_all($vname, $info,$namearr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($fname, $info,$fnamearr);
       for($i =0;$i<12;$i++){   
           $zimg=$imgarr[1][$i];//取出图片链接
           $zname=$namearr[2][$i];//取出影片名字
		   $fname=$fnamearr[1][$i];//取出影片评分
		   $fname=$fnamearr[1][$i];//取出影片评分
           $gul=$namearr[1][$i];
           $tok=base64_encode($gul);
           //echo $zname;
           //echo $gul;//取出播放链接
           echo "
		   <li  class='item'><a class='js-tongjic' href='mplay.php?cx=$gul' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='pay'>$fname</span>       <span class='hint'></span>
         </div>
         <div class='detail'>
          <p class='title g-clear'>
		    <span class='s1'>$zname</span>
			<span class='s2'></span></p>
           <p class='star'>$zstar</p>
          </div>
         </a></li>";
       }
	   ?>