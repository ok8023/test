<?php
//���´���ΪPHP���Ĵ��� �������� �����޸�
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$info=file_get_contents($aik['zhanwai']);
//print_r($info);
$szz1='#<li><a href="/index.php/show/index/(.*?)"><b></b><img src="(.*?)" /><span>(.*?)</span></a></li>
#';
preg_match_all($szz1, $info,$sarr1);
       for($i =0;$i<12;$i++){   
           $zname=$sarr1[3][$i];//����
           $two=$sarr1[1][$i];//ID                                              
           $zimg=$sarr1[2][$i];//ͼƬ
          $link="mplay.php?mso=".$two;
           //echo $zname;
           //echo $gul;//ȡ����������
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