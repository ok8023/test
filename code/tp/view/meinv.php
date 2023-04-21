<?php
if(!$ycm){exit;}
?>
<?php 
	if($_GET['tag']){
		$title = title($_GET['tag'],'meinvtag').' - '.$site_name;;
	}else{
		$title = title($_GET['id'],'meinv').' - '.$site_name;
	}
	include 'head.php';
	$page = isset($_GET['page'])?$_GET['page']:1;
	if($_GET['id']){
		meinv($_GET['id'],$page);
	}elseif($_GET['tag']){
		meinvtag($_GET['tag'],$page);
	}else{
		meinv_index('最新');
		meinv_index('cosplay');
		meinv_index('性感美女');
		meinv_index('游戏美女');
	}
	include 'foot.php';

	function meinv_index($name){
		$url = file_get_contents('http://www.win4000.com/meitu.html');
		if($name=='最新'){
			$li = '<li>'.$name.'图片</li>';
			preg_match('/<h2>'.$name.'图片<\/h2>(.*?)<div\s+class=\"lis/sS',$url,$content);
		}else{
			if($name=='性感美女'){
				$tag = 4;
			}elseif($name=='cosplay'){
				$tag = '26';
			}elseif($name=='游戏美女'){
				$tag = '7';
			}
			$li = '<li><a href="./index.php?mod=meinvtag&id='.$tag.'">'.$name.'图片</a></li>';
			preg_match('/<h2>'.$name.'图片<\/h2><a\s+href=\"(.*?)<div\s+class=\"lis/sS',$url,$content);
		}
		preg_match_all('/href=\"(.*?)\"/sS',$content[1],$img_id); //图片编号
		preg_match_all('/data-original\s+=\s+\"(.*?)\"/sS',$content[1],$img_url); //图片地址
		preg_match_all('/alt=\'(.*?)\'/sS',$content[1],$img_name); //图片名称
		for($i=0;$i<count($img_id[1]);$i++){
			$res['id'] = $img_id[1];
			$res['img'] = $img_url[1];
			$res['name'] = $img_name[1];
		}
		echo '<div class="container"><br>
		<div class="bg-image" style="background-image: url(http://wx.1314521.love/img/bg.jpg);">
		<div class="content content-full bg-flat-op">
		<div class="row">
		<div class="col-xs-12">
		<h1 class="page-heading text-white text-center js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown"">
		<font size="4">'.$name.'图片</font>
		</h1>
		</div>
		<!--div class="col-xs-6 text-right">
		<a class="btn btn-info btn-minw btn-rounded" href="index.php">
		<i class="fa fa-arrow-left push-5-r"></i> 返回
		</a>
		</div-->
		</div>
		</div>
		</div>
		<div class="content content-mini bg-white">
		<ol class="breadcrumb push">
		<li><a class="link-effect" href="index.php">首页</a></li>
		'.$li.'
		</ol>
		</div>
		<br>';
		for($i=0;$i<8;$i++){
			echo '<div class="col-sm-6 col-xs-6 col-bg-6 col-lg-3 animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
				<div class="block">
					<a href="#">
				<div class="img-container fx-opt-zoom-out">
				<img id="img_'.midstr($res['id'][$i],'nv','.').'" class="img-responsive" style="heimax-height:350px;min-height:350px;" src="'.$res['img'][$i].'">
				<script>if($(window).width() < 640){$("#img_'.midstr($res['id'][$i],'nv','.').'").attr("style","width:300px;max-height:250px;min-height:250px");}</script>
				<div class="img-options">
					<div class="img-options-content">
					<div class="push-20">
					<a class="btn btn-sm btn-default" onclick="img_show_big(\''.$res['img'][$i].'\')"><i class="fa fa-search"></i> 大图</a>
					<a class="btn btn-sm btn-default" href="?mod=meinv&id='.midstr($res['id'][$i],'nv','.').'"><i class="fa fa-search-plus"></i> 套图</a>
					</div>
					<div class="text-success">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-full"></i>
					</div>
					</div>
				</div>
				</div>
				<div class="block-content">
				<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><font size="2" class="text-muted">'.$res['name'][$i].'</font></div><br><br>
				</div>
					</a>
				</div>
		</div>';
		}
		echo '</div></div>
		<script>
			function img_show_big(url){
				layer.open({
				  type: 1,
				  title: false,
				  closeBtn: 0,
				  area: ["auto"],
				  skin: "layui-layer-nobg",
				  shadeClose: true,
				  content: "<img style=\"width:auto;max-height:550px;min-height:550px\" src="+url+">"
				});
			}
		</script>';
	}

	function title($id,$mod){
		if($mod=='meinv'){
			$url = file_get_contents('http://www.win4000.com/meinv'.$id.'_1.html');
			preg_match('/<h1>(.*?)</sS',$url,$title);
			if($title[1]){
				return $title[1];
			}else{
				return '美女图片';
			}
		}elseif($mod=='meinvtag'){
			$url = file_get_contents('http://www.win4000.com/meinvtag'.$id.'_1.html');
			preg_match('/<h2>(.*?)</sS',$url,$title);
			if($title[1]){
				return $title[1];
			}else{
				return '美女图片';
			}

		}
	}

	function meinv($id,$page){
		global $qun;
		global $qq;
		global $site_time;
		global $site_name;
		global $site_url;
		global $ad;
		$url = file_get_contents('http://www.win4000.com/meinv'.$id.'_'.$page.'.html');
		preg_match('/<div\s+class=\"breadcrumbs\">(.*?)<b>简介<\/b>/sS',$url,$content);
		preg_match('/当前位置：(.*?)<\/span/sS',$content[0],$weizhi_content);
		preg_match_all('/>(.*?)</sS',$weizhi_content[0],$weizhi); //位置
		if(!$weizhi_content){
			error_404();
		}
		preg_match_all('/href=\"(.*?)\">/sS',$weizhi_content[0],$tag_url_weizhi);//位置标签url
		preg_match('/time\">(.*?)</sS',$content[0],$time); //时间
		preg_match('/图片尺寸是：<em>(.*?)</sS',$content[0],$size); //尺寸
		preg_match('/>（(.*?)）</sS',$content[0],$page_show); //页面
		preg_match('/>（<span>(.*?)<\/span>\/<em>(.*?)</sS',$content[0],$page_show_total); //页面
		preg_match('/data-original=\"(.*?)\"/sS',$content[0],$img_url); //页面
		preg_match('/prev-img\"><a\s+href=\"(.*?)"/sS',$content[0],$prev_url); //上一张
		preg_match('/next-img\"><a\s+href=\"(.*?)"/sS',$content[0],$next_url);	//下一站
		preg_match('/标签：(.*?)<\/d/sS',$content[1],$tag_content); //标签内容
		preg_match_all('/<a\s+href=\"(.*?)\"/sS',$tag_content[1],$tag['url']); //标签内容
		preg_match_all('/\">(.*?)</sS',$tag_content[1],$tag['name']); //标签内容
		preg_match('/<b>简介<\/b>\s+<p>'.$weizhi[1][7].'。(.*?)<\/p/sS',$url,$jianjie); //简介
		preg_match('/<div\s+class=\"Left_bar\">(.*?)<div\s+class=\"Righ/sS',$url,$bottom_content);//底部
		preg_match_all('/href=\"(.*?)\"/sS',$bottom_content[1],$bottom['id']); //图片编号
		preg_match_all('/data-original=\"(.*?)\"/sS',$bottom_content[1],$bottom['url']); //图片地址
		preg_match_all('/alt=\'(.*?)\'/sS',$bottom_content[1],$bottom['name']); //图片名称
		for($i=0;$i<count($bottom['name'][1]);$i++){
			$res['id'] = $bottom['id'][1];
			$res['img'] = $bottom['url'][1];
			$res['name'] = $bottom['name'][1];
		}
		if(midstr($prev_url[1],'nv','_') && midstr($next_url[1],'nv','_')){
			$prev_btn = 'index.php?mod=meinv&id='.$id.'&page='.($page-1);
			$next_btn = 'index.php?mod=meinv&id='.$id.'&page='.($page+1);
		}elseif(!midstr($prev_url[1],'nv','_') && midstr($next_url[1],'nv','_')){
			$prev_status = true;
			$next_status = false;
			$prev_btn = 'index.php?mod=meinv&id='.midstr($prev_url[1],'nv','.').'&page=1';
			$next_btn = 'index.php?mod=meinv&id='.$id.'&page='.($page+1);
		}elseif(midstr($prev_url[1],'nv','_') && !midstr($next_url[1],'nv','_')){
			$prev_status = false;
			$next_status = true;
			$prev_btn = 'index.php?mod=meinv&id='.$id.'&page='.($page-1);
			$next_btn = 'index.php?mod=meinv&id='.midstr($next_url[1],'nv','.').'&page=1';
		}
		$name = $weizhi[1][7];
		echo '<div class="container"><br>
		<div class="bg-image" style="background-image: url(http://wx.1314521.love/img/bg.jpg);">
		<div class="content content-full bg-flat-op">
		<div class="row">
		<div class="col-xs-12">
		<h1 class="page-heading text-white text-center js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown"">
		<font size="4">'.$name.'</font>
		</h1>
		</div>
		<!--div class="col-xs-6 text-right">
		<a class="btn btn-info btn-minw btn-rounded" href="index.php">
		<i class="fa fa-arrow-left push-5-r"></i> 返回
		</a>
		</div-->
		</div>
		</div>
		</div>
		<div class="content content-mini bg-white">
		<ol class="breadcrumb push">
		<li><a class="link-effect" href="index.php">首页</a></li>
		<li><a class="link-effect" href="index.php?mod=meinv">美女图片</a></li>
		<li><a class="link-effect" href="index.php?mod=meinv&tag='.midstr($tag_url_weizhi[1][2],'tag','_').'">'.$weizhi[1][5].'</a></li>
		<li>'.$name.'</li>
		</ol>
		</div>
		<br>
<div class="row">
<div class="col-lg-8">
<div class="block block-rounded">
<div class="block-content">
	<h5 class="text-center">'.$name.'('.$page_show[1].')</h5><br>
	<div class="text-center" style="color:#999"><i class="fa fa-clock-o"></i>'.$time[1].'&nbsp;&nbsp;<i class="fa fa-picture-o"></i>'.$size[1].'&nbsp;&nbsp;<i class="fa fa-user"></i>'.$site_url.'</div><hr>
	<div class="alert alert-info text-center">点击图片即可放大观看哦</div>
	<div class="text-center animated fadeIn">
	<a onclick="tz(\'prev\',\''.$prev_btn.'\')"> <li class="fa fa-chevron-circle-left fa-3x"></li> </a>
		<a onclick="img(\''.$img_url[1].'\')" class="img-link img-thumb"><img id="img_show" style="width:500px;max-height:666px;min-height:666px" src="'.$img_url[1].'"></a>
	<a onclick="tz(\'next\',\''.$next_btn.'\')"> <li class="fa fa-chevron-circle-right fa-3x"></li> </a>
	</div>
	<center>
		<ul class="pagination">';
			for($i=1;$i<=$page_show_total[2];$i++){
				if($page==$i){
					$active = 'active';
				}else{
					$active = '';
				}
				echo '<li class="'.$active.'"><a href="./index.php?mod=meinv&id='.$id.'&page='.$i.'">'.$i.'</a></li>';
			}
		echo'</ul>
	</center>
</div>
</div>
</div>
<div class="col-lg-4">
<div class="block block-rounded">
	<div class="block-header bg-modern text-center">
	<h3 class="block-title" style="color:#ffffff;">套图简介</h3>
	</div>
	<div class="block-content">
	<table class="table table-borderless table-condensed">
	<tbody>
	<tr><td><i class="fa fa-fw fa-book push-10-r"></i> '.$name.'</td></tr>
	<tr><td><i class="fa fa-fw fa-calendar push-10-r"></i> '.str_replace("美桌网win4000.com","".$site_name."".$site_url."",$jianjie[1]).'</td></tr>
	<tr>
	<td>
	<i class="fa fa-fw fa-tags push-10-r"></i>';
	for($i=0;$i<count($tag['name'][1]);$i++){
			if($tag['name'][1][$i]=='美桌网'){
				continue;
			}
			echo '<a class="btn btn-link btn-xs" href="?mod=meinv&tag='.midstr($tag['url'][1][$i],'tag','_').'">'.$tag['name'][1][$i].'</a> ';
			}
	echo'</td>
	</tr>
	</tbody>
	</table>
	</div>
</div>
<div class="block block-rounded">
	<div class="block-header bg-smooth text-center">
	<h3 class="block-title" style="color:#ffffff;">本站推荐</h3>
	</div>
	<div class="block-content block-content-full text-center">
		'.$ad.'
	</div>
</div>
<div class="block block-rounded">
	<div class="block-header bg-amethyst text-center">
		<h3 class="block-title" style="color:#ffffff;">本站简介</h3>
		</div>
		<div class="block-content block-content-full text-center">
		<div class="push">
		<img class="img-avatar" src="http://q4.qlogo.cn/headimg_dl?dst_uin=2248186422&spec=100" alt="">
		</div>
		<div class="font-w600 push-5">'.$site_name.'</div>
		<div class="text-muted">'.$site_url.'</div>
		运行天数：'.$site_time.'天<br>
		建站初衷是为了提供一个舒心、有爱的交流环境,希望各位都能感受到「家」的温暖！<br>
		感谢您的来访<br>
		好东西记得分享哦
		<hr>
		<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='.$qq.'&site=qq&menu=yes" class="btn btn-primary"><li class="fa fa-qq"></li> 联系站长</a>
		<a target="_blank" href="'.$qun.'" class="btn btn-success"><li class="fa fa-users"></li> Ｑ交流群</a>
	</div>
</div>

</div>
</div>
</section>
<div class="col-bg-12">';
echo '<div><h3 class="font-w400 text-black push-0-t push-10">'.$weizhi[1][5].'图片<font size="2"><a href="?mod=meinv&tag='.midstr($tag_url_weizhi[1][2],'tag','_').'">=>更多</a></font></h3>';
		for($i=0;$i<8;$i++){
			echo '<div class="col-sm-6 col-xs-6 col-bg-6 col-lg-3 animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
				<div class="block">
					<a href="#">
				<div class="img-container">
				<img id="img_'.$i.'" class="img-responsive" style="heimax-height:350px;min-height:350px;" src="'.$res['img'][$i].'">
				<script>if($(window).width() < 640){$("#img_'.$i.'").attr("style","width:300px;max-height:250px;min-height:250px");}</script>
				<div class="img-options">
					<div class="img-options-content">
					<div class="push-20">
					<a class="btn btn-sm btn-default" onclick="img_show_big(\''.$res['img'][$i].'\')"><i class="fa fa-search"></i> 大图</a>
					<a class="btn btn-sm btn-default" href="?mod=meinv&id='.midstr($res['id'][$i],'nv','.').'"><i class="fa fa-search-plus"></i> 套图</a>
					</div>
					<div class="text-success">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-full"></i>
					</div>
					</div>
				</div>
				</div>
				<div class="block-content">
				<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><font size="2" class="text-muted">'.$res['name'][$i].'</font></div><br><br>
				</div>
					</a>
				</div>
		</div>';
		}
		echo '</div>';
echo'</div></div>
<script>
	if($(window).width() < 640){
        $("#img_show").attr("style","width:300px;max-height:500px;min-height:500px");
    }

    function img_show_big(url){
		layer.open({
		  type: 1,
		  title: false,
		  closeBtn: 0,
		  area: ["auto"],
		  skin: "layui-layer-nobg",
		  shadeClose: true,
		  content: "<img style=\"width:auto;max-height:550px;min-height:550px\" src="+url+">"
		});
	}

	function img(url){
		layer.open({
		  type: 1,
		  title: false,
		  closeBtn: 0,
		  area: ["auto"],
		  skin: "layui-layer-nobg",
		  shadeClose: true,
		  content: "<img style=\"width:auto;max-height:550px;min-height:550px\" src="+url+">"
		});
	}

	function tz(mod,url){
		var prev = "'.$prev_status.'";
		var next = "'.$next_status.'";
		if(mod=="next" && next){
			layer.confirm("本套图已完结是否跳转至下一组套图", {
			title:"友情提示",
			btn: ["跳转","再看看"]
			}, function(){
				window.location.href=url;
			}, function(){
				
			});
		}else if(mod=="prev" && prev){
			layer.confirm("本套图是第一张是否跳转至上一组套图", {
			title:"友情提示",
			btn: ["跳转","再看看"]
			}, function(){
				window.location.href=url;
			}, function(){
				
			});
		}else{
			window.location.href=url;
		}

	}
</script>';
	}

	function meinvtag($id,$page){
		$url = file_get_contents('http://www.win4000.com/meinvtag'.$id.'_'.$page.'.html');
		preg_match('/<div\s+class=\"breadcrumbs\">(.*?)<div\s+class=\"Right_bar\">/sS',$url,$content);
		preg_match('/当前位置：(.*?)<\/span/sS',$content[0],$weizhi_content);
		preg_match_all('/>(.*?)</sS',$weizhi_content[0],$weizhi); //位置
		preg_match_all('/<h2>'.$weizhi[1][5].'<\/h2>(.*?)<div\s+class=\"page/sS',$content[0],$content);
		preg_match_all('/href=\"(.*?)\"/sS',$content[1][0],$img_id); //图片编号
		preg_match_all('/data-original=\"(.*?)\"/sS',$content[1][0],$img_url); //图片地址
		preg_match_all('/alt=\"(.*?)\"/sS',$content[1][0],$img_name); //图片名称
		preg_match('/<div\s+class=\"pages\">(.*?)<div\s+class=\"Right_ba/sS',$url,$page_html);
		preg_match_all('/\">(.*?)</sS',$page_html[1],$page_num);
		preg_match_all('/href=\"(.*?)\"/sS',$page_html[1],$page_url);
		for($i=0;$i<count($img_id[1]);$i++){
			$res['id'] = $img_id[1];
			$res['img'] = $img_url[1];
			$res['name'] = $img_name[1];
		}
		$name = $weizhi[1][5];
		echo '<div class="container"><br>
		<div class="bg-image" style="background-image: url(http://wx.1314521.love/img/bg.jpg);">
		<div class="content content-full bg-flat-op">
		<div class="row">
		<div class="col-xs-12">
		<h1 class="page-heading text-white text-center js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown"">
		<font size="4">'.$name.'</font>
		</h1>
		</div>
		<!--div class="col-xs-6 text-right">
		<a class="btn btn-info btn-minw btn-rounded" href="index.php">
		<i class="fa fa-arrow-left push-5-r"></i> 返回
		</a>
		</div-->
		</div>
		</div>
		</div>
		<div class="content content-mini bg-white">
		<ol class="breadcrumb push">
		<li><a class="link-effect" href="index.php">首页</a></li>
		<li><a class="link-effect" href="index.php?mod=meinv">美女图片</a></li>
		<li>'.$name.'</li>
		</ol>
		</div>
		<br>';
		for($i=0;$i<count($res['id']);$i++){
			echo '<div class="col-sm-6 col-xs-6 col-bg-6 col-lg-3 animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
				<div class="block">
					<a href="#">
				<div class="img-container fx-opt-zoom-out">
				<img id="img_'.$i.'" class="img-responsive" style="heimax-height:350px;min-height:350px;" src="'.$res['img'][$i].'">
				<script>if($(window).width() < 640){$("#img_'.$i.'").attr("style","width:300px;max-height:250px;min-height:250px");}</script>
				<div class="img-options">
					<div class="img-options-content">
					<div class="push-20">
					<a class="btn btn-sm btn-default" onclick="img_show_big(\''.$res['img'][$i].'\')"><i class="fa fa-search"></i> 大图</a>
					<a class="btn btn-sm btn-default" href="?mod=meinv&id='.midstr($res['id'][$i],'nv','.').'"><i class="fa fa-search-plus"></i> 套图</a>
					</div>
					<div class="text-success">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-half-full"></i>
					</div>
					</div>
				</div>
				</div>
				<div class="block-content">
				<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><font size="2" class="text-muted">'.$res['name'][$i].'</font></div><br><br>
				</div>
					</a>
				</div>
		</div>
		<script>
			function img_show_big(url){
				layer.open({
				  type: 1,
				  title: false,
				  closeBtn: 0,
				  area: ["auto"],
				  skin: "layui-layer-nobg",
				  shadeClose: true,
				  content: "<img style=\"width:auto;max-height:550px;min-height:550px\" src="+url+">"
				});
			}
		</script>';
		}
		echo '<center>
		<ul class="pagination">';
			for($i=0;$i<count($page_url[1]);$i++){
				if($page_num[1][$i]=='上一页'){
					$page = ($_GET['page']-1);
				}elseif($page_num[1][$i]=='下一页'){
					$page = ($_GET['page']+1);
				}else{
					$page = $page_num[1][$i];
				}
				echo '<li><a href="./index.php?mod=meinv&tag='.$id.'&page='.$page.'">'.$page_num[1][$i].'</a></li>';
			}
		echo'</ul>
	</center></div></div>
		</div></div>';
	}
?>
