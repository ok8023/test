<?php
//http://list.youku.com/category/video/c_94_g_236_d_1_s_1_p_1.html
error_reporting(0);
include ('./data/init.php');
$lurl='http://www.360kan.com/dianshi/list';
$lurl1='http://www.360kan.com/dianying/list';
$lurl2='http://www.360kan.com/dongman/list';
$lurl3='http://www.360kan.com/zongyi/list.php';
$lurl4='http://list.youku.com/category/video/c_94_d_1_s_1_p_1.html';
$list=curl_get($lurl);//电视剧页面
$list1=curl_get($lurl1);//电影页面
print_r($list1);
$list2=curl_get($lurl2);//动漫页面
$list3=curl_get($lurl3);//综艺页面
$list4=curl_get($lurl4);//搞笑页面
$lzz='#<a class="js-tongjip" href="http://www.360kan.com/dianshi/list\?year=all\&area\=all\&act\=all\&cat\=(.*?)" target="_self">(.*?)</a>#';
$lzzmv='#<a class="js-tongjip" href="http://www.360kan.com/dianying/list.php\?year=all\&area=all\&act=all\&cat=(.*?)" target="_self">(.*?)</a>#';
$lzzdm='#<a class="js-tongjip" href="http://www.360kan.com/dongman/list.php\?year=all\&area=all\&cat=(.*?)" target="_self">(.*?)</a>#';
//动漫分类
$lzzzy='#<a class="js-tongjip" href="http://www.360kan.com/zongyi/list.php\?act=all\&area=all\&cat=(.*?)" target="_self">(.*?)</a>#';
//剧情
$lzz1='# <a class="js-tongjip" href="http://www.360kan.com/dianshi/list\?cat\=all\&area=all\&act\=all\&year\=(.*?)" target="_self">(.*?)</a>#';
//年代
$lzz2='#<a class="js-tongjip" href="http://www.360kan.com/dianshi/list\?cat\=all\&year\=all\&act\=all\&area\=(.*?)" target="_self">(.*?)</a>#';
//地区
preg_match_all($lzz, $list,$larr);//剧情  
preg_match_all($lzz1, $list,$larr1);//年代
preg_match_all($lzz2, $list,$larr2);//地区
preg_match_all($lzzmv, $list1,$larrmv);//剧情  
preg_match_all($lzzdm, $list2,$larrdm);//剧情 
preg_match_all($lzzzy, $list3,$larrzy);//剧情 
$cat=$larr[1];//剧情分类id
$mcat=$larrmv[1];
$dmcat=$larrdm[1];
$zycat=$larrzy[1];
$dmname=$larrdm[2];
$zyname=$larrzy[2];
//print_r($larrmv);
$mname=$larrmv[2];
$cat1=$larr1[1];//年代id
$cat2=$larr2[1];//地区id
$name=$larr[2];//分类名字
//echo http_build_query($larr1[1]);
//print_r($larr);
//以上为电视剧

?>
