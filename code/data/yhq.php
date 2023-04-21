<?php
//以下代码为PHP核心代码 如若不明 请勿修改
error_reporting(0);
header('Content-type:text/html;charset=utf-8');
$num = range(1,19);
shuffle($num);
$info=file_get_contents('http://demo.dataoke.com/index.php?r=nine');
$info = strstr($info, '<div class="swiper_center">') ;
$vname='#<a class="text" href="(.*?)" >(.*?)</a>#';                        
$imgg='#<img src="(.*?)" alt="">#';
$quanh='#<span>(.*?)</span>#';
preg_match_all($vname,$info,$namearr);
preg_match_all($imgg,$info,$imggarr);   
preg_match_all($quanh,$info,$quanharr); 
           $img=$imggarr[1];//取出图片链接
           $name=$namearr[2];//取出名字
		   $iidd=$namearr[1];//取出名字
		   $daih=$quanharr[1]; 
		   $unionurl=$aik['dtk_ad'];  
		for ($i=0; $i < 6; $i++) {
		$k=$num[$i];
		?>
		
		
	  <style>.s0{word-wrap: break-word;font-size: 13px;color: #999;width: 190px;height: 40px;line-height: 15px;}
		  </style>
		  <li  class='item'><a class='js-tongjic' href='<?php echo $unionurl.$iidd[$k]?>' title='<?php echo $name[$k]?>' target='_blank'>
         <div class='cover g-playicon'>
          <img src='<?php echo $img[$k]?>' alt='<?php echo $name[$k]?>' />
		  <span class='hint' style='right:50px;'>券后价￥</span>
		  <span class='hint' style='background:#fef07e;width: 40px; height:30px; line-height:30px;text-align: center; font-size:14px; font-weight:bold; color:#ff435e;'><?php echo $daih[$k]?></span>
         </div>
         <div class='detail'>
          <p class='title g-clear' style=' margin-top:5px;'>
		    <span class='s0'><?php echo $name[$k]?></span></p>
          </div>
	</a></li>		
 <?php }?>