<?php
if(!$ycm){exit;}
?>
<?php
	if($_GET['tag']){
		$title = title($_GET['tag'],'wapbztag').' - '.$site_name;
	}else{
		$title = title($_GET['id'],'wapbz').' - '.$site_name;
	}
	include './view/head.php';
	$page = isset($_GET['page'])?$_GET['page']:1;
	$tag = isset($_GET['tag'])?$_GET['tag']:'';
	if($_GET['tag']){
		bizhi_index($tag);
	}elseif($_GET['id']){
		bizhi($_GET['id'],$page);
	}else{
		bizhi_index($tag='_0_0_0_1');
	}
	include './view/foot.php';

	function bizhi($id,$page){
		global $qun;
		global $qq;
		global $site_time;
		global $site_url;
		global $site_name;
		$url = file_get_contents('http://www.win4000.com/mobile_detail_'.$id.'_'.$page.'.html');
		preg_match('/<div\s+class=\"breadcrumbs\">(.*?)<b>简介<\/b>/sS',$url,$content);
		preg_match('/当前位置：(.*?)<\/span/sS',$content[0],$weizhi_content);
		preg_match_all('/>(.*?)</sS',$weizhi_content[0],$weizhi); //位置
		if(!$weizhi_content){
			error_404();
		}
		preg_match_all('/href=\"(.*?)\">/sS',$weizhi_content[0],$tag_url_weizhi);//位置标签url
		preg_match('/time\">(.*?)</sS',$content[0],$time); //时间
		preg_match('/尺寸是：<em>(.*?)</sS',$content[0],$size); //尺寸
		preg_match('/>（(.*?)）</sS',$content[0],$page_show); //页面
		preg_match('/>（<span>(.*?)<\/span>\/<em>(.*?)</sS',$content[0],$page_show_total); //页面
		preg_match('/src=\"(.*?)\"/sS',$content[0],$img_url); //页面
		preg_match('/prev-img\"><a\s+href=\"(.*?)"/sS',$content[0],$prev_url); //上一张
		preg_match('/next-img\"><a\s+href=\"(.*?)"/sS',$content[0],$next_url);	//下一站
		preg_match('/标签：(.*?)<\/d/sS',$content[1],$tag_content); //标签内容
		preg_match_all('/<a\s+href=\"(.*?)\"/sS',$tag_content[1],$tag['url']); //标签内容
		preg_match_all('/\">(.*?)</sS',$tag_content[1],$tag['name']); //标签内容
		preg_match('/<b>简介<\/b>\s+<p>(.*?)<\/p/sS',$url,$jianjie); //简介
		preg_match('/'.$weizhi[1][5].'手机壁纸推荐<\/h2><a\s+href=\"(.*?)<div\s+class=\"Righ/sS',$url,$bottom_content);//底部
		preg_match_all('/href=\"(.*?)\"/sS',$bottom_content[1],$bottom['id']); //图片编号
		preg_match_all('/data-original=\"(.*?)\"/sS',$bottom_content[1],$bottom['url']); //图片地址
		preg_match_all('/alt=\"(.*?)\"/sS',$bottom_content[1],$bottom['name']); //图片名称
		for($i=0;$i<count($bottom['name'][1]);$i++){
			$res['id'] = $bottom['id'][1];
			$res['img'] = $bottom['url'][1];
			$res['name'] = $bottom['name'][1];
		}
		if(midstr($prev_url[1],'il_','_') && midstr($next_url[1],'il_','_')){
			$prev_btn = 'index.php?mod=wapbz&id='.$id.'&page='.($page-1);
			$next_btn = 'index.php?mod=wapbz&id='.$id.'&page='.($page+1);
		}elseif(!midstr($prev_url[1],'il_','_') && midstr($next_url[1],'il_','.')){
			$prev_status = true;
			$next_status = false;
			$prev_btn = 'index.php?mod=wapbz&id='.midstr($prev_url[1],'il_','.').'&page=1';
			$next_btn = 'index.php?mod=wapbz&id='.$id.'&page='.($page+1);
		}elseif(midstr($prev_url[1],'il_','_') && !midstr($next_url[1],'il_','_')){
			$prev_status = false;
			$next_status = true;
			$prev_btn = 'index.php?mod=wapbz&id='.$id.'&page='.($page-1);
			$next_btn = 'index.php?mod=wapbz&id='.midstr($next_url[1],'il_','.').'&page=1';
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
		<li><a class="link-effect" href="index.php?mod=wapbz">手机壁纸</a></li>
		<li><a class="link-effect" href="index.php?mod=wapbz&tag='.midstr($tag_url_weizhi[1][1],'le','.').'">'.$weizhi[1][5].'</a></li>
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
		<a onclick="img(\''.$img_url[1].'\')" class="img-link img-thumb"><img id="img_show" style="width:400px;max-height:666px;min-height:666px" src="'.$img_url[1].'"></a>
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
				echo '<li class="'.$active.'"><a href="./index.php?mod=wapbz&id='.$id.'&page='.$i.'">'.$i.'</a></li>';
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
	<!--td>
	<i class="fa fa-fw fa-tags push-10-r"></i>';
	for($i=0;$i<count($tag['name'][1]);$i++){
			if($tag['name'][1][$i]=='美桌网'){
				continue;
			}
			echo '<a class="btn btn-link btn-xs" href="?mod=wapbz&bztag='.midstr($tag['url'][1][$i],'zt/','.').'">'.$tag['name'][1][$i].'</a> ';
			}
	echo'</td-->
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
		AD
	</div>
</div>
<div class="block block-rounded">
	<div class="block-header bg-amethyst text-center">
		<h3 class="block-title" style="color:#ffffff;">本站简介</h3>
		</div>
		<div class="block-content block-content-full text-center">
		<div class="push">
		<img class="img-avatar" src="http://q4.qlogo.cn/headimg_dl?dst_uin=1900432277&spec=100" alt="">
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
echo '<div><h3 class="font-w400 text-black push-0-t push-10">'.$weizhi[1][5].'手机壁纸推荐<font size="2"><a href="?mod=wapbz&tag='.midstr($tag_url_weizhi[1][1],'le','.').'">=>更多</a></font></h3>';
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
					<a class="btn btn-sm btn-default" href="?mod=wapbz&id='.midstr($res['id'][$i],'il_','.').'"><i class="fa fa-search-plus"></i> 套图</a>
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

	function title($id,$mod){
		if($mod=='wapbz'){
			$url = file_get_contents('http://www.win4000.com/mobile_detail_'.$id.'_1.html');
			preg_match('/<h1>(.*?)</sS',$url,$title);
			if($title[1]){
				return $title[1];
			}else{
				return '手机壁纸';
			}
		}elseif($mod=='wapbztag'){
			$url = file_get_contents('http://www.win4000.com/mobile'.$id.'.html');
			preg_match('/<title>(.*?)_/sS',$url,$title);
			if($title[1]){
				return $title[1];
			}else{
				return '手机壁纸';
			}

		}
	}

	function bizhi_index($tag){
		$url = file_get_contents('http://www.win4000.com/mobile'.$tag.'.html');
		preg_match('/<div\s+class=\"breadcrumbs\">(.*?)<div\s+class=\"a1000/sS',$url,$content);
		if(!$content){
			error_404();
		}
		preg_match('/当前位置：(.*?)<\/span/sS',$content[0],$weizhi_content);
		preg_match_all('/>(.*?)</sS',$weizhi_content[0],$weizhi); //位置
		preg_match_all('/部<\/a>(.*?)<\/div/sS',$content[0],$bz_content);
		preg_match_all('/href=\"(.*?)\"/sS',$bz_content[1][0],$bz_fenlei_url);
		preg_match_all('/\">(.*?)</sS',$bz_content[1][0],$bz_fenlei_name);
		preg_match_all('/href=\"(.*?)\"/sS',$bz_content[1][1],$bz_size_url);
		preg_match_all('/\">(.*?)</sS',$bz_content[1][1],$bz_size_name);
		preg_match_all('/href=\"(.*?)\"/sS',$bz_content[1][2],$bz_color_url);
		$color_arr = array('','background-color:#fff100','background-color:#f39800','background-color:#e60012','background-color:#ed9cad','background-color:#d700ea','background-color:#b3d465','background-color:#00b7ee','background-color:#cccccc','background-color:#000000','background-image: linear-gradient(120deg, #a6c0fe 0%, #f68084 100%)','background-image: linear-gradient(to top, #cfd9df 0%, #e2ebf0 100%);');
		preg_match('/<div\s+class=\"w1180\s+clearfix\">(.*?)<div\s+class=\"pa/sS',$content[0],$img_content);
		preg_match_all('/data-original=\"(.*?)\"/sS',$img_content[1],$img_src);
		preg_match_all('/href=\"(.*?)\"/sS',$img_content[1],$img_url);
		preg_match_all('/alt=\"(.*?)\"/sS',$img_content[1],$img_title);
		preg_match('/<div\s+class=\"pages\">(.*?)<div\s+class=\"Right_ba/sS',$url,$page_html);
		preg_match_all('/\">(.*?)</sS',$page_html[1],$page_num);
		preg_match_all('/href=\"(.*?)\"/sS',$page_html[1],$page_url);
		if($tag=='_0_0_0_1'){
			$all_active = 'btn btn-info';
		}else{
			$all_active = '';
		}
		echo '<div class="container"><br>
		<div class="bg-image" style="background-image: url(http://wx.1314521.love/img/bg.jpg);">
		<div class="content content-full bg-flat-op">
		<div class="row">
		<div class="col-xs-12">
		<h1 class="page-heading text-white text-center js-appear-enabled animated fadeInDown" data-toggle="appear" data-class="animated fadeInDown"">
		<font size="4">'.$weizhi[1][4].'</font>
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
		<li>'.$weizhi[1][4].'</li>
		</ol>
		</div>
		<br>
		<div class="timeline-event-block block js-appear-enabled animated fadeIn" data-toggle="appear">
            <div class="block-content block-content-full">
                壁纸分类<br><a href="./index.php?mod=wapbz&tag=_0_0_0_1" class="btn btn-link '.$all_active.'">全部</a>';
	      		for($i=0;$i<=count($bz_fenlei_name[1]);$i++){
	      			if(midstr($bz_fenlei_url[1][$i],'e','.')==$tag){
	      				$active = 'btn-info';
	      			}else{
	      				$active = '';
	      			}
					echo '<a class="btn btn-link '.$active.'" href="./index.php?mod=wapbz&tag='.midstr($bz_fenlei_url[1][$i],'e','.').'">'.$bz_fenlei_name[1][$i].'</a>';
				}
				echo'<br>壁纸尺寸<br><a href="./index.php?mod=wapbz&tag=_0_0_0_1" class="btn btn-link '.$all_active.'">全部</a>';
	      		for($i=0;$i<=count($bz_size_name[1]);$i++){
	      			if(midstr($bz_size_url[1][$i],'e','.')==$tag){
	      				$active = 'btn-info';
	      			}else{
	      				$active = '';
	      			}
					echo '<a class="btn btn-link '.$active.'" href="./index.php?mod=wapbz&tag='.midstr($bz_size_url[1][$i],'e','.').'">'.$bz_size_name[1][$i].'</a>';
				}
				echo'<br>壁纸颜色<br><a href="./index.php?mod=wapbz&tag=_0_0_0_1" class="btn btn-link '.$all_active.'">全部</a>';
	      		for($i=1;$i<=11;$i++){
	      			if('_0_'.$i.'_0_1'==$tag){
	      				$active = 'border: 2px solid #666;box-shadow: 0 0 1px #000000;';
	      			}else{
	      				$active = '';
	      			}
					echo '<a class="btn btn-link" style="'.$active.'" href="./index.php?mod=wapbz&tag=_0_'.$i.'_0_1"><div style="'.$color_arr[$i].';width:16px!important;height:16px!important;padding:0!important;margin:5px 0 0 14px !important;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;}"></div></a>';
				}
	          echo'</div>
        </div>';
        for($i=0;$i<count($img_url[1]);$i++){
			echo '<div class="col-sm-6 col-xs-6 col-bg-6 col-lg-3 animated fadeIn" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
				<div class="block">
					<a href="#">
				<div class="img-container">
				<img id="img_'.$i.'" class="img-responsive" style="heimax-height:350px;min-height:350px;" src="'.$img_src[1][$i].'">
				<script>if($(window).width() < 640){$("#img_'.$i.'").attr("style","width:300px;max-height:250px;min-height:250px");}</script>
				<div class="img-options">
					<div class="img-options-content">
					<div class="push-20">
					<a class="btn btn-sm btn-default" onclick="img_show_big(\''.$img_src[1][$i].'\')"><i class="fa fa-search"></i> 大图</a>
					<a class="btn btn-sm btn-default" href="?mod=wapbz&id='.midstr($img_url[1][$i],'il_','.').'"><i class="fa fa-search-plus"></i> 套图</a>
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
				<div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><font size="2" class="text-muted">'.$img_title[1][$i].'</font></div><br><br>
				</div>
					</a>
				</div>
		</div>';
		}
		echo '</div>
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
		echo '<center>
		<ul class="pagination">';
			for($i=0;$i<count($page_url[1]);$i++){
				echo '<li><a href="./index.php?mod=wapbz&tag='.midstr($page_url[1][$i],'le','.').'">'.$page_num[1][$i].'</a></li>';
			}
		echo'</ul>
	</center></div></div>';
	}
?>