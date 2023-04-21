<?php
include ('./inc/aik.config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta http-equiv="cache-control" content="no-siteapp">
<title><?php echo $aik['title'];?>-免VIP抢先观看最新好看的电影和电视剧</title>
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/play.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>
<meta name="keywords" content="<?php echo $aik['title'];?>,电视直播网站,零八影院快播,高清云影视,云点播,免费看视频,湖南卫视直播,80电影网,最新电影天堂免费在线观看">
<meta name="description" content="<?php echo $aik['title'];?>,热剧快播,最好看的剧情片尽在<?php echo $aik['title'];?>,高清云影视免费为大家提供最新最全的免费电影，电视剧，综艺，动漫无广告在线云点播，以及电视直播">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body>
<body class="page-template page-template-pages page-template-posts-film page-template-pagesposts-film-php page page-id-9">
<?php  include 'header.php';?>
<div class="single-post">
<section class="container">
    <div class="content-wrap">
        <div class="content">
<div class="asst asst-post_header"><?php echo $aik['bofang_ad'];?></div><br>
<div class="sptitle"></div>
<div id="bof">
</div>
<div class="am-cf"></div>
<div class="am-panel am-panel-default">
<div class="am-panel-bd">
<div class="bofangdiv">
<img id="addid" src="images/1280jiazai.png" style="display: none;width:100%;border: 2px solid #ff6651">
<iframe id="video" allowFullScreen=ture src="http://ivi.bupt.edu.cn/player.html?channel=cctv1hd" style="width:100%;border:none"></iframe>
<a style="display:none" id="videourlgo" href=""></a>
</div>
<div id="xlu">
</div>

<?php echo $aik['tishi_ad'];?>
<div class="dianshijua" id="dianshijuid">
<h3 class='single-strong'>无需安装任何插件<font color='#ff6651'><?php echo $aik['dbts'];?></font></h3>
<div class="top-list-ji">
    <h2 class="title g-clear"><em class="a-bigsite a-bigsite-leshi"></em></h2>
    <div class="ji-tab-content js-tab-content" style="opacity:1;">
        <a  target="ajax" id="CCTV-1高清" href="http://ivi.bupt.edu.cn/player.html?channel=cctv1hd">CCTV-1高清</a>
        <a  target="ajax" id="CCTV-3高清" href="http://ivi.bupt.edu.cn/player.html?channel=cctv3hd">CCTV-3高清</a>
        <a  target="ajax" id="CCTV-5+高清" href="http://ivi.bupt.edu.cn/player.html?channel=cctv5phd">CCTV-5+高清</a>
        <a  target="ajax" id="CCTV-6高清" href="http://ivi.bupt.edu.cn/player.html?channel=cctv6hd">CCTV-6高清</a>
        <a  target="ajax" id="CCTV-8高清" href="http://ivi.bupt.edu.cn/player.html?channel=cctv8hd">CCTV-8高清</a>
        <a  target="ajax" id="CHC高清电影" href="http://ivi.bupt.edu.cn/player.html?channel=chchd">CHC高清电影</a>
        <a  target="ajax" id="北京卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=btv1hd">北京卫视高清</a>
        <a  target="ajax" id="北京文艺高清" href="http://ivi.bupt.edu.cn/player.html?channel=btv2hd">北京文艺高清</a>
        <a  target="ajax" id="北京纪实高清" href="http://ivi.bupt.edu.cn/player.html?channel=btv11hd">北京纪实高清</a>
        <a  target="ajax" id="湖南卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=hunanhd">湖南卫视高清</a>
        <a  target="ajax" id="浙江卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=zjhd">浙江卫视高清</a>
        <a  target="ajax" id="江苏卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=jshd">江苏卫视高清</a>
        <a  target="ajax" id="东方卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=dfhd">东方卫视高清</a>
        <a  target="ajax" id="安徽卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=ahhd">安徽卫视高清</a>
        <a  target="ajax" id="黑龙江卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=hljhd">黑龙江卫视高清</a>
        <a  target="ajax" id="辽宁卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=lnhd">辽宁卫视高清</a>
        <a  target="ajax" id="深圳卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=szhd">深圳卫视高清</a>
        <a  target="ajax" id="广东卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=gdhd">广东卫视高清</a>
        <a  target="ajax" id="天津卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=tjhd">天津卫视高清</a>
        <a  target="ajax" id="湖北卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=hbhd">湖北卫视高清</a>
        <a  target="ajax" id="山东卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=sdhd">山东卫视高清</a>
        <a  target="ajax" id="重庆卫视高清" href="http://ivi.bupt.edu.cn/player.html?channel=cqhd">重庆卫视高清</a>
        <a  target="ajax" id="CCTV-1综合" href="http://ivi.bupt.edu.cn/player.html?channel=cctv1">CCTV-1综合</a>
        <a  target="ajax" id="CCTV-2财经" href="http://ivi.bupt.edu.cn/player.html?channel=cctv2">CCTV-2财经</a>
        <a  target="ajax" id="CCTV-3综艺" href="http://ivi.bupt.edu.cn/player.html?channel=cctv3">CCTV-3综艺</a>
        <a  target="ajax" id="CCTV-4中文国际" href="http://ivi.bupt.edu.cn/player.html?channel=cctv4">CCTV-4中文国际</a>
        <a  target="ajax" id="CCTV-6电影" href="http://ivi.bupt.edu.cn/player.html?channel=cctv6">CCTV-6电影</a>
        <a  target="ajax" id="CCTV-7军事农业" href="http://ivi.bupt.edu.cn/player.html?channel=cctv7">CCTV-7军事农业</a>
        <a  target="ajax" id="CCTV-8电视剧" href="http://ivi.bupt.edu.cn/player.html?channel=cctv8">CCTV-8电视剧</a>
        <a  target="ajax" id="CCTV-9纪录" href="http://ivi.bupt.edu.cn/player.html?channel=cctv9">CCTV-9纪录</a>
        <a  target="ajax" id="CCTV-10科教" href="http://ivi.bupt.edu.cn/player.html?channel=cctv10">CCTV-10科教</a>
        <a  target="ajax" id="CCTV-11戏曲" href="http://ivi.bupt.edu.cn/player.html?channel=cctv11">CCTV-11戏曲</a>
        <a  target="ajax" id="CCTV-12社会与法" href="http://ivi.bupt.edu.cn/player.html?channel=cctv12">CCTV-12社会与法</a>
        <a  target="ajax" id="CCTV-13新闻" href="http://ivi.bupt.edu.cn/player.html?channel=cctv13">CCTV-13新闻</a>
        <a  target="ajax" id="CCTV-14少儿" href="http://ivi.bupt.edu.cn/player.html?channel=cctv14">CCTV-14少儿</a>
        <a  target="ajax" id="CCTV-15音乐" href="http://ivi.bupt.edu.cn/player.html?channel=cctv15">CCTV-15音乐</a>
        <a  target="ajax" id="CCTV-NEWS" href="http://ivi.bupt.edu.cn/player.html?channel=cctv16">CCTV-NEWS</a>
        <a  target="ajax" id="北京卫视" href="http://ivi.bupt.edu.cn/player.html?channel=btv1">北京卫视</a>
        <a  target="ajax" id="北京文艺" href="http://ivi.bupt.edu.cn/player.html?channel=btv2">北京文艺</a>
        <a  target="ajax" id="北京科教" href="http://ivi.bupt.edu.cn/player.html?channel=btv3">北京科教</a>
        <a  target="ajax" id="北京影视" href="http://ivi.bupt.edu.cn/player.html?channel=btv4">北京影视</a>
        <a  target="ajax" id="北京财经" href="http://ivi.bupt.edu.cn/player.html?channel=btv5">北京财经</a>
        <a  target="ajax" id="北京生活" href="http://ivi.bupt.edu.cn/player.html?channel=btv7">北京生活</a>
        <a  target="ajax" id="北京青年" href="http://ivi.bupt.edu.cn/player.html?channel=btv8">北京青年</a>
        <a  target="ajax" id="北京新闻" href="http://ivi.bupt.edu.cn/player.html?channel=btv9">北京新闻</a>
        <a  target="ajax" id="北京卡酷少儿" href="http://ivi.bupt.edu.cn/player.html?channel=btv10">北京卡酷少儿</a>
        <a  target="ajax" id="深圳卫视" href="http://ivi.bupt.edu.cn/player.html?channel=sztv">深圳卫视</a>
        <a  target="ajax" id="安徽卫视" href="http://ivi.bupt.edu.cn/player.html?channel=ahtv">安徽卫视</a>
        <a  target="ajax" id="河南卫视" href="http://ivi.bupt.edu.cn/player.html?channel=hntv">河南卫视</a>
        <a  target="ajax" id="陕西卫视" href="http://ivi.bupt.edu.cn/player.html?channel=sxtv">陕西卫视</a>
        <a  target="ajax" id="吉林卫视" href="http://ivi.bupt.edu.cn/player.html?channel=jltv">吉林卫视</a>
        <a  target="ajax" id="广东卫视" href="http://ivi.bupt.edu.cn/player.html?channel=gdtv">广东卫视</a>
        <a  target="ajax" id="山东卫视" href="http://ivi.bupt.edu.cn/player.html?channel=sdtv">山东卫视</a>
        <a  target="ajax" id="湖北卫视" href="http://ivi.bupt.edu.cn/player.html?channel=hbtv">湖北卫视</a>
        <a  target="ajax" id="广西卫视" href="http://ivi.bupt.edu.cn/player.html?channel=gxtv">广西卫视</a>
        <a  target="ajax" id="河北卫视" href="http://ivi.bupt.edu.cn/player.html?channel=hebtv">河北卫视</a>
        <a  target="ajax" id="西藏卫视" href="http://ivi.bupt.edu.cn/player.html?channel=xztv">西藏卫视</a>
        <a  target="ajax" id="内蒙古卫视" href="http://ivi.bupt.edu.cn/player.html?channel=nmtv">内蒙古卫视</a>
        <a  target="ajax" id="青海卫视" href="http://ivi.bupt.edu.cn/player.html?channel=qhtv">青海卫视</a>
        <a  target="ajax" id="四川卫视" href="http://ivi.bupt.edu.cn/player.html?channel=sctv">四川卫视</a>
        <a  target="ajax" id="江苏卫视" href="http://ivi.bupt.edu.cn/player.html?channel=jstv">江苏卫视</a>
        <a  target="ajax" id="天津卫视" href="http://ivi.bupt.edu.cn/player.html?channel=tjtv">天津卫视</a>
        <a  target="ajax" id="山西卫视" href="http://ivi.bupt.edu.cn/player.html?channel=sxrtv">山西卫视</a>
        <a  target="ajax" id="辽宁卫视" href="http://ivi.bupt.edu.cn/player.html?channel=lntv">辽宁卫视</a>
        <a  target="ajax" id="厦门卫视" href="http://ivi.bupt.edu.cn/player.html?channel=xmtv">厦门卫视</a>
        <a  target="ajax" id="新疆卫视" href="http://ivi.bupt.edu.cn/player.html?channel=xjtv">新疆卫视</a>
        <a  target="ajax" id="东方卫视" href="http://ivi.bupt.edu.cn/player.html?channel=dftv">东方卫视</a>
        <a  target="ajax" id="黑龙江卫视" href="http://ivi.bupt.edu.cn/player.html?channel=hljtv">黑龙江卫视</a>
        <a  target="ajax" id="湖南卫视" href="http://ivi.bupt.edu.cn/player.html?channel=hunantv">湖南卫视</a>
        <a  target="ajax" id="云南卫视" href="http://ivi.bupt.edu.cn/player.html?channel=yntv">云南卫视</a>
        <a  target="ajax" id="江西卫视" href="http://ivi.bupt.edu.cn/player.html?channel=jxtv">江西卫视</a>
        <a  target="ajax" id="福建东南卫视" href="http://ivi.bupt.edu.cn/player.html?channel=dntv">福建东南卫视</a>
        <a  target="ajax" id="浙江卫视" href="http://ivi.bupt.edu.cn/player.html?channel=zjtv">浙江卫视</a>
        <a  target="ajax" id="贵州卫视" href="http://ivi.bupt.edu.cn/player.html?channel=gztv">贵州卫视</a>
        <a  target="ajax" id="宁夏卫视" href="http://ivi.bupt.edu.cn/player.html?channel=nxtv">宁夏卫视</a>
        <a  target="ajax" id="甘肃卫视" href="http://ivi.bupt.edu.cn/player.html?channel=gstv">甘肃卫视</a>
        <a  target="ajax" id="重庆卫视" href="http://ivi.bupt.edu.cn/player.html?channel=cqtv">重庆卫视</a>
        <a  target="ajax" id="兵团卫视" href="http://ivi.bupt.edu.cn/player.html?channel=bttv">兵团卫视</a>
        <a  target="ajax" id="旅游卫视" href="http://ivi.bupt.edu.cn/player.html?channel=lytv">旅游卫视</a>

</div>
</div>          
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

<script type="text/javascript">
    function bofang(mp4url){
        document.getElementById('videourlgo').href=mp4url;
        document.getElementById('video').src=mp4url;
        

        //点击之后
        document.getElementById('video').style.display='none';
        document.getElementById('addid').style.display = 'block';
        document.getElementById('xlu').style.display = 'block';
        function test() {
            document.getElementById('video').style.display='block';
            document.getElementById('addid').style.display = 'none';
        }
        setTimeout(test, 1000);
    };
</script>
<div style="clear: both;"></div> 
</div>
</div>
<div class="article-actions clearfix">
 <div class="shares">
        <strong>分享到：</strong>
        <a href="javascript:;" data-url="<?php echo $aik['pcdomain'];?>" class="share-weixin" title="分享到微信"><i class="fa"></i></a><a etap="share" data-share="qzone" class="share-qzone" title="分享到QQ空间"><i class="fa"></i></a><a etap="share" data-share="weibo" class="share-tsina" title="分享到新浪微博"><i class="fa"></i></a><a etap="share" data-share="tqq" class="share-tqq" title="分享到腾讯微博"><i class="fa"></i></a><a etap="share" data-share="qq" class="share-sqq" title="分享到QQ好友"><i class="fa"></i></a><a etap="share" data-share="renren" class="share-renren" title="分享到人人网"><i class="fa"></i></a><a etap="share" data-share="douban" class="share-douban" title="分享到豆瓣网"><i class="fa"></i></a>
    </div>   
 <a href="javascript:;" class="action-rewards" etap="rewards">打赏</a>
    </div> 
</div>
        </div>
<?php  include 'sidebar.php';?>
</section>
</div>
<?php  include 'footer.php';?>
</body>
</html>
