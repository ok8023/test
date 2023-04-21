<?php
include ('./inc/aik.config.php');
?>
<header class="header">
	<div class="container">
		<h1 class="logo"><a href="<?php echo $aik['pcdomain'];?>" title="<?php echo $aik['keywords'];?>"><?php echo $aik['logo_dh'];?><span><?php echo $aik['title'];?></span></a></h1>		<div class="sitenav">
		<ul>
		<li class="menu-item"><a href="<?php echo $aik['pcdomain']?>">首页</a>

<li class="menu-item"><a href="./movieh.php">电影</a></li>
<li class="menu-item"><a href="./tvh.php">电视剧</a></li>
<li class="menu-item  menu-item-has-children"><a href="./zongyih.php">综艺</a>
<ul class="sub-menu">
	<li class="menu-item"><a href="./dongmanh.php">动漫</a></li>
	<li class="menu-item"><a href="./cxlisth.php">尝鲜</a></li>
	<li class="menu-item"><a href="./zhibo.php">电视台直播</a></li>
</ul>

<li class="menu-item  menu-item-has-children"><a href="#">综合其他</a>
<ul class="sub-menu">
	<li class="menu-item"><a href="./gaoxiao.php">搞笑娱乐</a></li>
	<li class="menu-item"><a href="yy.php?list=t10027.html">美女热舞</a></li>
	<li class="menu-item"><a href="music.php">在线音乐</a></li>
	<li class="menu-item"><a href="./top.php">热搜榜单</a></li>
		<li class="menu-item"><a href="./tp/">高清美图</a></li>
</ul>
</li>
<li class="menu-item  menu-item-has-children"><a href="<?php echo $aik['dtk_ad']?>" target="_blank">官方资讯</a>
<ul class="sub-menu">
	<li class="menu-item"><a href="./yhq.php">优惠券搜索</a></li>
	<li class="menu-item"><a href="javascript:history.back(-1)" target="_blank">返回上页</a></li>
	<li class="menu-item"><a href="http://h.zy40.cn/gjdq/dh/inde.html" target="_blank">更多资源</a></li>
	<li class="menu-item"><a target="_blank" href="http://www.zy40.cn">资源论坛</a></li>
</ul>
</li>
<li class="menu-item"><?php echo $aik['top_ad'];?></li>
<li class="menu-item"><?php echo $aik['top1_ad'];?></li>
</ul>
		</div>
		<span class="sitenav-on"><i class="icon-list"></i></span>
		<span class="sitenav-mask"></span>
					<div class="accounts">
					<a class="account-weixin" href="javascript:;"><i class="fa"></i>
						<div class="account-popover"><div class="account-popover-content"><?php echo $aik['weixin_ad'];?></div></div>
					</a>
<script type='text/javascript' src='js/view-history.js'></script>
<script>
var store = $.AMUI.store;
 document.writeln("<a class=\'account-tqq\' target=\'_blank\' href=\'"+store.get('siteurl') +"' tipsy title='"+store.get('site') +"'></a>");
    </script>
					
																			</div>
							<span class="searchstart-on"><i class="icon-search"></i></span>
			<span class="searchstart-off"><i class="icon-search"></i></span>
			<form method="get" class="searchform" action="./seacher.php" >
				<button tabindex="3" class="sbtn" type="submit"><i class="fa"></i></button><input tabindex="2" class="sinput" name="sousuo" type="text" placeholder="输入关键字" value="">
			</form>
              
			</div>
</header>
