<?php
//���´���ΪPHP���Ĵ��� �������� �����޸�
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
include './inc/config.php';

$info=file_get_contents('http://www.360kan.com/dianying/list.php?cat=all&year=all&area=all&act=all&rank=createtime');
//print_r($info);
$vname='#<span class="s1">(.*?)</span>#';//ȡ����Ӱ������
$vlist='#<a class="js-tongjic" href="(.*?)">#';//����
$vstar='#<p class="star">(.*?)</p>#';//ȡ����Ӱ������

$vimg='#<div class="cover g-playicon">
                                <img src="(.*?)">#';//ȡ����Ӱ�ķ���
$nname='#<span class="hint">(.*?)</span>#';
$fname='#<span class="s2">(.*?)</span>#';
$array = array();
//��Ӱ����Ϣ�������� ��ʼ
preg_match_all($vname, $info,$namearr);
preg_match_all($vlist, $info,$listarr);
preg_match_all($vstar, $info,$stararr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($nname, $info,$nnamearr);
preg_match_all($fname, $info,$fnamearr);
       for($i =0;$i<12;$i++){   
	       $gul=$listarr[1][$i];//ȡ����������
           $zimg=$imgarr[1][$i];//ȡ��ͼƬ����
           $zname=$namearr[1][$i];//ȡ��ӰƬ����
		   $fname=$fnamearr[1][$i];//ȡ��ӰƬ����
		   $nname=$nnamearr[1][$i];//ȡ��ӰƬ���
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