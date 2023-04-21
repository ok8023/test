<?php
error_reporting(0);
include "./inc/aik.config.php";
function unicode_decode($name){
	$json = '{"str":"'.$name.'"}';
	$arr = json_decode($json,true);
	if(empty($arr)) return '';
	return $arr['str'];
}
function httpget($url, $timeout = 30)
{
    $ch = curl_init();                                                      //初始化 curl
    curl_setopt($ch, CURLOPT_URL, $url);                                    //要访问网页 URL 地址
    curl_setopt($ch, CURLOPT_NOBODY, false);                                //设定是否输出页面内容
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                         //返回字符串，而非直接输出到屏幕上
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, false);                        //连接超时时间，设置为 0，则无限等待
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);                            //数据传输的最大允许时间超时,设为一小时
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);                       //HTTP验证方法
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                        //不检查 SSL 证书来源
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);                        //不检查 证书中 SSL 加密算法是否存在
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);                         //跟踪爬取重定向页面
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);                            //当Location:重定向时，自动设置header中的Referer:信息
    curl_setopt($ch, CURLOPT_ENCODING, '');                                 //解决网页乱码问题
    curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    
    $httpheaders = array();
    $httpheaders[] = "CLIENT-IP: {$_SERVER['HTTP_CLIENT_IP']}";
    $httpheaders[] = "X-FORWARDED-FOR: {$_SERVER['HTTP_X_FORWARDED_FOR']}";
    curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheaders);
    
    $data = curl_exec($ch);                                                 //运行 curl，请求网页并返回结果
    curl_close($ch);                                                        //关闭 curl
    return $data;
}
$link = base64_decode($_GET["play"]);
$url_array = explode("/", $link);
$player = "https://www.360kan.com" . $link;
$tvinfo = httpget($player);
$tvinfo = str_replace('-->', '', "$tvinfo");
$tvinfo = str_replace('<!--', '', "$tvinfo");
$tvinfo = urldecode(str_replace('https://p.ssl.so.com/p/', '', "$tvinfo"));
$tvzz='#<div (class="site-wrap")?\s*id="js-site-wrap">[\s\S]+?(class="num-tab-main\s*g-clear\s*js-tab")?\s*(style="display:none;")?>[\s\S]+?<a data-num="(.*?)"\s*data-daochu="to=(.*?)" href="(.*?)">[\s\S]+?</div>#';
$tvzz1 = '#<a data-num="(.*?)"\s*data-daochu="to=(.*?)" href="(.*?)">#';
$dyzz= '#<span class="txt">站点排序 ：</span>[\s\S]+?<div style=\' visibility:hidden\'#';
$bflist = "#<a data-daochu=\"to=(.*?)\" class=\"btn js-site ea-site ea-site-(.*?)\" href=\"(.*?)\">(.*?)</a>#";
$jianjie = '#style="display:none;"><span>简介[\s\S]+?js-close btn#';
$jianjie1 = '#</span>(.*?)<a href#';
$biaoti = '#<h1>(.*?)</h1>#';
$pan = '#<h2 class="title g-clear">(.*?)</h2>#';
$pan1 = '#<div id="js-juji" class="juji g-clear p-mod"(.*?)data-site#';
$mkcmsid=str_replace('.html', '', "$url_array[2]");
$mkcmstyle=$url_array[1];
$laiyuan = '#{"ensite":"(.*?)","cnsite":"(.*?)","vip":(.*?)}#';

preg_match_all($jianjie, $tvinfo, $jjarr1);
$jjarr1 = implode($glue, $jjarr1[0]);
$jjarr1 = str_replace(PHP_EOL, '', $jjarr1);
preg_match_all($jianjie1, $jjarr1, $jjarr);
preg_match_all($tvzz, $tvinfo, $tvarr);
preg_match_all($dyzz, $tvinfo, $dyarr);
preg_match_all($pan, $tvinfo, $ptvarr);
preg_match_all($pan1, $tvinfo, $ptvarr1);
preg_match_all($dyzz, $tvinfo, $tvlist);
preg_match_all($biaoti, $tvinfo, $btarr);
$mvsrc = implode($glue, $tvlist[0]);
preg_match_all($bflist, $mvsrc, $dyarr1);
//剧集动漫多来源判断
preg_match_all($laiyuan, $tvinfo, $laiyuanarr);
$yuan=$laiyuanarr[1];//来源英文
$yuanname=$laiyuanarr[2];//来源中文
//电影链接
$dysrc=$dyarr1[0];
$c=$dyarr1[3];//电影的播放链接
foreach ($c as $k => $yk) {//屏蔽优酷付费视频跳转
	$c[$k] = str_replace("http://cps.youku.com/redirect.html?id=0000028f&url=", "", $yk);
}
$d=$dyarr1[4];//电影来源
$gx=$gengxino[1][0];
$e=strip_tags($daoyano[0][0]);
if(!empty($e)){
	$e=strip_tags($daoyano[0][0]);
}else{
	$e=strip_tags($bochuo[0][0]);
}
$f=strip_tags($leixingo[0][0]);
$g=$niandaio[3][0];
$h=$diquo[3][0];
$hh=$diquo1[4][0];
$hi=strip_tags($zhuyano[0][0]);
if(!empty($hi)){
	$hi=strip_tags($zhuyano[0][0]);
}else{
	$hi=strip_tags($mingxingo[0][0]);
}
$jian = $jjarr[1][0];//简介
$jian = str_replace('<p class="item-desc">', '', "$jian");
$timu = $btarr[1][0];//标题
$imgs = $tparr[1][0];//图片
$panduan = $ptvarr[1][0];
$panduan1 = $ptvarr1[1][0];
$zyv="#<div class=\"g-clear js-month-page\" style=\"display:block;\">[\s\S]+?<div monitor-desc#";
$qi="#<span class='w-newfigure-hint'>(.*?)</span>#";
$zyimg="#data-src='(.*?)' alt='(.*?)'#";
preg_match_all($zyv, $tvinfo,$zyvarr);
$zylist = implode($glue, $zyvarr[0]);
$ztlizz="#<a href='(.*?)' data-url='(.*?)' data-specialurl='(.*?)' data-daochu=to=(.*?) class='js-link'><div class='w-newfigure-imglink g-playicon js-playicon'>#";
preg_match_all($ztlizz, $zylist,$zyliarr);
preg_match_all($qi, $zylist,$qiarr);
preg_match_all($zyimg, $zylist,$imgarr);
$zyvi=$zyliarr[1];
$noqi=$qiarr[1];
$zypic=$imgarr[1];
$zyname=$imgarr[2];
$zcf = implode($glue, $tvarr[0]);
preg_match_all($tvzz1, $zcf, $tvar1);
$b = $tvar1[3];
$much = 1;
?>
<?php
$pizza = $aik["qq_name"];
$pieces = explode("#", $pizza);
if (!empty($pizza) && in_array($timu, $pieces)) {
?><meta http-equiv=refresh content='0; url=404.php'><?php
	exit(0);
} else {
	echo "";
}
?><!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/play.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<script>
	
$(function(){
		
			var $li = $('#mytab li');
			var $ul = $('#mycontent ul');
						
			$li.click(function(){
				var $this = $(this);
				var $t = $this.index();
				$li.removeClass();
				$this.addClass('current');
				$ul.css('display','none');
				$ul.eq($t).css('display','block');
			})
		
});

</script>
<meta name="keywords" content="<?php echo $timu;?>-播放页">
<title>正在播放-<?php echo $timu;?>-<?php echo $aik["sitename"];?></title>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>  <style>
* { padding:0px;}					
#myouter {width:100%;}
#mytab { height: 40px; width:100%; }
#mytab  li { list-style-type:none; width:13%; float:left; text-align:center;}
#mytab li {float:left;height:40px;	cursor:pointer;	line-height:40px; font-size:0.8em;font-weight:bold;border:1px solid #ff6651;-moz-border-radius: 15px; 
-webkit-border-radius: 15px; 
border-radius:15px  }
#mytab li.current { color:#fff; background:#ff6651; font-weight:bold; border:2px solid #ff6651; -moz-border-radius: 15px; 
-webkit-border-radius: 15px; 
border-radius:15px  }
#mycontent { height: auto; }
#mycontent ul {line-height:25px;display:none;}						
.w-newfigure{list-style:none; float:left;}
</style>
<body>
<?php
include "header.php";
?><div class="single-post">
<section class="container">
    <div class="content-wrap">
    	<div class="content"><!--删掉可全屏-->
<div class="asst asst-post_header"><?php echo $aik["bofang_ad"];?></div>
<div class="sptitle"><h1><?php echo $timu;?></h1></div>
<div id="bof">
</div>
<div class="am-cf"></div>
<div class="am-panel am-panel-default">
<div class="am-panel-bd">

<div class="bofangdiv">
<img id="addid" src="images/1280jiazai.png" style="display: none;width:100%;border: 2px solid #ff6651">
<?php
if ($url_array[1] == "m") {
?><iframe id="video" allowFullScreen=ture src="<?php echo $aik["jiekou1"];?><?php echo $c[0];?>" style="width:100%;border:none"></iframe><?php
} else {
?><iframe id="video" allowFullScreen=ture src="jiazai.php" style="width:100%;border:none"></iframe><?php
}
?><a style="display:none" id="videourlgo" href=""></a>
</div>
<div id="xlu">
<button onclick="xldata('<?php echo $aik["jiekou1"];?>')">线路一</button>
<button onclick="xldata('<?php echo $aik["jiekou2"];?>')">线路二</button>
<button onclick="xldata('<?php echo $aik["jiekou3"];?>')">线路三</button>
<button onclick="xldata('<?php echo $aik["jiekou4"];?>')">线路四</button>
<button onclick="xldata('<?php echo $aik["jiekou5"];?>')">线路五</button>
</div>
	<script type="text/javascript">
function xldata(urls){
	var videourls = document.getElementById('video');
	var xlqieh = document.getElementById('videourlgo');
	videourls.src = urls+xlqieh.href;
}
</script>

<div style="clear: both;"></div> 
<div id="xuji"></div>
<?php echo $aik["tishi_ad"];?><div id="fade" class="black_overlay"> 
</div> 
<div class="video-list view-font">
<script type="text/javascript">
	var al = $('.num-tab-main a');
	al.attr('class','am-btn am-btn-default lipbtn');
	var ji= new Array();
	var btnji= new Array();
	for(var g=0;g<al.length;g++){
		ji.push(al[g].href);
		btnji.push(al[g].id);
		al[g].href = 'javascript:void(0)';
		al[g].target = '_self';
		al.eq(g).attr('onclick','bofang(\''+ji[g]+'\',\''+btnji[g]+'\')');
	};
	 if($("div").hasClass("js-tab-main")){ 
	var taba = $('.js-tab-main a');
	for(var g=0;g<taba.length;g++){
		taba.eq(g).attr('onclick','tabqh(\''+[g]+'\')');
	};
	var numtba = $('.num-tab .num-tab-main');
	for(var g=0;g<numtba.length;g++){
		numtba.eq(g).attr('id','num'+[g]);
	};
	document.getElementById('num1').style.display = 'block';
	function tabqh(ylen){
		var idylen = parseInt(ylen);
		var tabalen = $('.js-tab-main a').length;
		for (var xcyh=0;xcyh<tabalen;xcyh++) {
			document.getElementById('num'+xcyh).style.display = 'none';
		}
		document.getElementById('num'+idylen).style.display = 'block';
	}
	 }
</script>


<div class="dianshijua" id="dianshijuid">
<h3 class="single-strong">无需安装任何插件<font color="#ff6651"><?php echo $aik["dbts"];?></font></h3> 
<div class="top-list-ji">
    <h2 class="title g-clear"><em class="a-bigsite a-bigsite-leshi"></em></h2>
    <div class="ji-tab-content js-tab-content" style="opacity:1;">
				<?php
				$num=1;
				if ($url_array[1] == "m") {
				foreach ($c as $kk => $vod) {
				$dyname = str_replace('(付费)', '', "$d[$kk]");
				echo "<a href='$vod' target='ajax' title='$timu'>$dyname</a>";$num++;}
				if (empty($vod)) {echo "<a>暂无资源</a>";}

				} else {
					$i=0;
					foreach ($yuan as $vv => $ly) {
						echo '<h3 class="title">'.unicode_decode("$yuanname[$vv]").'播放列表</h3>';
						$site = $ly;
						$id=$mkcmsid;
						if ($url_array[1] == "tv"){
							$category="2";}
							else{
								$category="4";
								}
				$url = "https://www.360kan.com/cover/switchsite?site=".$site."&id=".$id."&category=".$category;
				$html = httpget($url,5);
				$data=json_decode($html, ture);
				$data=implode("",$data);
				$tvzzx = "#<div class=\"num-tab-main g-clear\\s*js-tab\"\\s*(style=\"display:block;\")?>[\\s\\S]+?<a data-num=\"(.*?)\" data-daochu=\"to=(.*?)\" href=\"(.*?)\">[\\s\\S]+?<\/div>\r<\/div>#";
				$tvzzy = '#<a data-num="(.*?)" data-daochu="to=(.*?)" href="(.*?)">#';
				preg_match_all($tvzzx, $data, $tvarry);
				$zcf = implode($glue, $tvarry[0]);
				preg_match_all($tvzzy,  $zcf, $tvarry);
				$b = $tvarry[3];
				$yeshu=$tvarry[1];
				foreach ($b as $yy => $tvurl) {
					echo "<a data-num='$yeshu[$yy]' href='$b[$yy]' class='btn-play-source' title='$timu.$yeshu[$yy]'>";
					echo '第'.$yeshu[$yy].'集</a>';}
				$i ++;}
				if ($url_array[1] == "va"){
				foreach ($zyvi as $keya=>$tvideoa){
				echo "<a data-num='$noqi[$keya]' href='$tvideoa' class='btn-play-source' title='$noqi[$keya]$zyname[$keya]'>$noqi[$keya]<br>$zyname[$keya]</a>";
				}
                }}?>
				</div>     
</div>
</div></div>
<div style="clear: both;"></div>
<p class="jianjie"><h3 class="single-strong">简介</h3><p class="item-desc js-close-wrap" ><?php echo $jian;?></p>
<div style="clear: both;"></div>
<?php echo $aik["changyan"];?><div style="clear: both;"></div>
</div>
<script type="text/javascript">
	var al = $('.dianshijua a');
	al.attr('class','am-btn am-btn-default lipbtn');
	var ji= new Array();
	var btnji= new Array();
	for(var g=0;g<al.length;g++){
		ji.push(al[g].href);
		btnji.push(al[g].id);
		al[g].href = 'javascript:void(0)';
		al[g].target = '_self';
		al.eq(g).attr('onclick','bofang(\''+ji[g]+'\',\''+btnji[g]+'\')');
	};
</script>
<?php
if ($url_array[1] == "tv") {
?><script type="text/javascript">
	function bofang(mp4url,jiid){
		var tishi = ('正在为您播放《<?php echo $timu;?>》 第'+jiid+'集,如不能播放请更换线路！');
		document.getElementById('videourlgo').href=mp4url;
		document.getElementById('xuji').innerHTML = tishi;
		if(mp4url.indexOf('iqiyi')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('qq')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('sohu')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('youku')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('tudou')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('le')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('58')>=0 && mp4url.indexOf('58')<5 ){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else{
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		};
		//点击之后
		document.getElementById('xuji').style.display='block';
		document.getElementById('video').style.display='none';
		document.getElementById('addid').style.display = 'block';
		document.getElementById('xlu').style.display = 'block';
		function test() {
			document.getElementById('video').style.display='block';
			document.getElementById('addid').style.display = 'none';
		}
		setTimeout(test, 5000);
	};
</script>
<?php
} else {
?><script type="text/javascript">
	function bofang(mp4url){
		document.getElementById('videourlgo').href=mp4url;
		if(mp4url.indexOf('iqiyi')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('qq')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('sohu')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('youku')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('tudou')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('le')>=0){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else if(mp4url.indexOf('58')>=0 && mp4url.indexOf('58')<5 ){
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		}else{
			document.getElementById('video').src='<?php echo $aik["jiekou1"];?>'+mp4url;
		};
		//点击之后
		document.getElementById('video').style.display='none';
		document.getElementById('addid').style.display = 'block';
		document.getElementById('xlu').style.display = 'block';
		function test() {
			document.getElementById('video').style.display='block';
			document.getElementById('addid').style.display = 'none';
		}
		setTimeout(test, 5000);
	};
</script>
<?php
}
?><script type='text/javascript' src='js/view-history.js'></script>
<script>
var store = $.AMUI.store;var lishi = $('#xuji1').html();store.set('site','<?php echo $timu;?>');      	 store.set('siteurl','<?php echo $_SERVER["REQUEST_URI"];?>');store.set('li',viewji)</script>
<script type="text/javascript">
 var temp = {type: "video", name: "<?php echo $timu;?>",url: "<?php echo $_SERVER["REQUEST_URI"];?>"};			
var histemp = store.get('history')? store.get('history'): [];
       for(var i=0; i<histemp.length; i++) {
            if(histemp[i].type == "video" && histemp[i].url == "<?php echo $_SERVER["REQUEST_URI"];?>") {
                histemp.splice(i, 1); 
                break;
            }
        }
histemp.unshift(temp); 
store.set('history', histemp);
//alert(JSON.stringify(store.get("history")));
var doo = store.get("history");
//$("#sc").html('"+store.get('history')+"');
function qc () {
	store.clear();
		
}
		</script>
		
</div>
<div class="article-actions clearfix">
 <div class="shares">
        <strong>分享到：</strong>
        <a href="javascript:;" data-url="<?php echo $aik["pcdomain"];?>" class="share-weixin" title="分享到微信"><i class="fa"></i></a><a etap="share" data-share="qzone" class="share-qzone" title="分享到QQ空间"><i class="fa"></i></a><a etap="share" data-share="weibo" class="share-tsina" title="分享到新浪微博"><i class="fa"></i></a><a etap="share" data-share="tqq" class="share-tqq" title="分享到腾讯微博"><i class="fa"></i></a><a etap="share" data-share="qq" class="share-sqq" title="分享到QQ好友"><i class="fa"></i></a><a etap="share" data-share="renren" class="share-renren" title="分享到人人网"><i class="fa"></i></a><a etap="share" data-share="douban" class="share-douban" title="分享到豆瓣网"><i class="fa"></i></a>
    </div>   
 <a href="javascript:;" class="action-rewards" etap="rewards">打赏</a>
    </div> 
</div>
    	</div>
<?php
include "sidebar.php";
?></section>
</div>
<?php
include "footer.php";
?></body>
</html>