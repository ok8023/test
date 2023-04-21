<?php
//以下代码为PHP核心代码 如若不明 请勿修改
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$page=$_GET['page'];
if (empty($page)){$page=1;}//页数 

$info=file_get_contents('http://www.1905.com/list-p-catid-220.html?page=' .$_GET['page']. '');
//print_r($info);
$vname='#<a href="https://www.1905.com/news/([0-9]+)/([0-9]+).shtml" target="_blank" class="pic-url picHover" title="(.*)">[\s]+?<img src="(.*)" data-original="(.*)" alt="(.*)" height="174" width="320">#';//取出电影的名字
$fname='#<p class="des">(.*)</p>#';
$vimg='#<span class="timer fl">(.*)</span>#';
$array = array();
preg_match_all($vname, $info,$namearr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($fname, $info,$fnamearr);
       for($i =0;$i<12;$i++){   
           $zimg=$namearr[5][$i];//取出图片链接
           $zname=$namearr[3][$i];//取出影片名字
		   $fname=$imgarr[1][$i];//取出影片评分
		   $fname=$fnamearr[1][$i];//取出影片评分
           $gul=$namearr[1][$i];

$gut=$namearr[2][$i];
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
