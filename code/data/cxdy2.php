<?php
//以下代码为PHP核心代码 如若不明 请勿修改
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$info=file_get_contents($aik['zhanwai']);
//print_r($info);
$szz1='#<li><a href="/index.php/show/index/(.*?)"><b></b><img src="(.*?)" /><span>(.*?)</span></a></li>
#';
preg_match_all($szz1, $info,$sarr1);
       for($i =0;$i<12;$i++){   
           $zname=$sarr1[3][$i];//名字
           $two=$sarr1[1][$i];//ID                                              
           $zimg=$sarr1[2][$i];//图片
          $link="mplay.php?mso=".$two;
           //echo $zname;
           //echo $gul;//取出播放链接
           echo "
		   <li  class='item'><a class='js-tongjic' href='$link' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
         
         </div>
         <div class='detail'>
          <p class='title g-clear'>
		    <span class='s1'>$zname</span></p>
          </div>
         </a></li>";
       }
	   ?>