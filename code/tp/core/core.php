<?php 
	error_reporting(0);
	$ycm = true;
	$mod = !empty($_GET['mod'])?$_GET['mod']:'';
	$page = isset($_GET['page'])?$_GET['page']:0;
	$qq = '2248186422';  //站长qq
	$qun = 'http://wpa.qq.com/'; //qq群
	$site_time = site_time('2020-3-15');
	$site_url = 'www.zy40.cn';
	$site_name = '美图网';
	$ad = '广告';

	function error_404(){
		exit('<div class="content bg-white text-center pulldown overflow-hidden">
			<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
			<h1 class="font-s128 font-w300 text-city animated flipInX">404</h1><hr>
			<h2 class="h3 font-w300 push-50 animated fadeInUp">
				哎呀，您的页面走丢了哦！<br>请检查您输入的网址是否有误~<br>
				<a class="btn btn-danger" onclick="history.go(-1);"><li class="fa fa-hand-o-left"></li> 上一页</a>
				<a class="btn btn-primary" href="./index.php"><li class="fa fa-bell"></li> 返回首页</a>
				<a target="_blank" href="'.$qun.'" class="btn btn-success"><li class="fa fa-qq"></li> 联系站长</a>
			</h2>');
	}

	function midstr($str,$str1,$str2){
		    $result='';
		    $l=strpos($str,$str1);
		    if(is_numeric($l))
		    {
		      $str=substr($str,$l+mb_strlen($str1));
		      $l=strpos($str,$str2);
		      if(is_numeric($l)) $result=substr($str,0,$l);
		    }
		    return $result;
	  }

	function daddslashes($string, $force = 0, $strip = FALSE) {
		!defined('MAGIC_QUOTES_GPC') && define('MAGIC_QUOTES_GPC', get_magic_quotes_gpc());
		if(!MAGIC_QUOTES_GPC || $force) {
			if(is_array($string)) {
				foreach($string as $key => $val) {
					$string[$key] = daddslashes($val, $force, $strip);
				}
			} else {
				$string = addslashes($strip ? stripslashes($string) : $string);
			}
		}
		return $string;
	}

	function site_time($end_date){
	    $start_time = strtotime(date('Y-m-d ').' 00:00:00');
		$end_time = strtotime($end_date);
		$days = abs(($start_time - $end_time) / 86400);
		return $days;
	}
?>
