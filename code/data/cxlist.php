<?php
//���´���ΪPHP���Ĵ��� �������� �����޸�
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$info=file_get_contents('http://www.yingdou.net/');
//print_r($info);
$szz1='#<a style="position:relative;display:block;" title="(.*?)" target="_blank" href="/html/(.*?)/index.html">#';
$szz2='#<button class="hdtag">(.*?)</button>#';
$szz3='#<img class="indexhot" title="(.*?)" alt="(.*?)" src="(.*?)">#';
preg_match_all($szz1, $info,$sarr1);
preg_match_all($szz2, $info,$sarr2);
preg_match_all($szz3, $info,$sarr3);
       for($i =0;$i<12;$i++){   
           $zname=$sarr1[1][$i];//����
           $two=$sarr1[2][$i];//ID
           $fname=$sarr2[1][$i];//��ע                                               
           $zimg=$sarr3[3][$i];//ͼƬ
          $link="mplay.php?yd=".$two."/1/1.html";
           //echo $zname;
           //echo $gul;//ȡ����������
           echo "
		   <li  class='item'><a class='js-tongjic' href='$link' title='$zname' target='_blank'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='pay'>$fname</span>       <span class='hint'></span>
         </div>
         <div class='detail'>
          <p class='title g-clear'>
		    <span class='s1'>$zname</span></p>
          </div>
         </a></li>";
       }
	   ?>