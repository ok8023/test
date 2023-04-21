<?php
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$url='http://www.360kan.com/dongman/list';
$info = curl_get($url);
define('360', 'www.360kan.com');
$yuming="http://www.360kan.com";
$vname='#<span class="s1">(.*?)</span>#';
$vlist='#<a class="js-tongjic" href="(.*?)">#';
$vstar='# <p class="star">(.*?)</p>#';
$nname='#<span class="hint">(.*?)</span>#';
$vimg='#<div class="cover g-playicon">
                                <img src="(.*?)">#';
$bflist='#<a data-daochu(.*?) href="(.*?)" class="js-site-btn btn btn-play"></a>#';
$array = array();
preg_match_all($vname, $info,$namearr);
preg_match_all($vlist, $info,$listarr);
preg_match_all($vstar, $info,$stararr);
preg_match_all($vimg, $info,$imgarr);
preg_match_all($nname, $info,$nnamearr);
	 for($i =0;$i<12;$i++){   
		   
	   $gul=$listarr[1][$i];
	   
           $cd=$host.'/alist.php?id='.$gul;
           $guq=$listarr[1][$i];
           $_GET['id']=$gul;
           //echo $guq;
           $zimg=$imgarr[1][$i];
           $zname=$namearr[1][$i];
		   $nname=$nnamearr[1][$i];
           $zstar=$stararr[1][$i];
           $jiami=base64_encode($gul);
            $chuandi='play.php?play='.$jiami;
           echo "<li class='item'><a class='js-tongjic' href='$chuandi' title='$zname'>
         <div class='cover g-playicon'>
          <img src='$zimg' alt='$zname' />
          <span class='hint'>$nname</span>
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