<?php
error_reporting(0);
include ('./inc/aik.config.php');
$id=$_GET['id'];
$cxurl = $aik['zhanwai'];
$url = $cxurl."?vodids=".$id;
$data=json_decode(file_get_contents($url),true);            

?>
<?php
$pizza = $aik['qq_name'];
$pieces = explode("#", $pizza); 
if ((!empty($pizza))&&(in_array($data['data'][0]['vod_name'], $pieces))) {
 echo "<meta http-equiv=refresh content='0; url=404.php'>";
die();
}
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
<link rel='stylesheet' id='main-css'  href='css/style.css' type='text/css' media='all' />
<link rel='stylesheet' id='main-css'  href='css/play.css' type='text/css' media='all' />
<script type='text/javascript' src='//apps.bdimg.com//libs/jquery/2.0.0/jquery.min.js?ver=0.5'></script>

<meta name="keywords" content="<?php echo $data['data'][0]['vod_name'];?>-播放页">
<title><?php echo $data['data'][0]['vod_name'];?>-正在播放-<?php echo $aik['sitename'];?></title>
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
</head>
<body class="page-template page-template-pages page-template-posts-play page-template-pagesposts-play-php page page-id-16">
<?php  include 'header.php';?>
<div class="single-post">
<section class="container">
    <div class="content-wrap">
        <div class="content">
<div class="asst asst-post_header"><?php echo $aik['bofang_ad'];?></div>
<div class="sptitle"><h1>
<?php echo $data['data'][0]['vod_name'];?></h1></div>
<div id="bof">
</div>
<div class="am-cf"></div>
<div class="am-panel am-panel-default">
<div class="am-panel-bd">
<div class="bofangdiv">
<img id="addid" src="images/1280jiazai.png" style="display: none;width:100%;border: 2px solid #ff6651">
<iframe id="video" allowFullScreen=ture src="./ck/index.php?url=<?php 
       $strr = $data['data'][0]['vod_url'];
                $suArrr = explode("$$$",$strr);
                foreach($suArrr as $aa=>$bb){  
                    $vv = explode("\n",$bb);
                    $dd[] =$vv; 
                }
                foreach($dd as $kk=>$vv){    
                         $uu = explode("$",$vv[0]);
                        if(strpos($uu[1] ,'.m3u8')){
                        $urlss= $uu[1];
                        echo $urlss;
                        }
                     
}

?>" style="width:100%;border:none"></iframe>
<a style="display:none" id="videourlgo" href=""></a>
</div>
<div id="xlu">
</div>

<?php echo $aik['tishi_ad'];?>
<div class="dianshijua" id="dianshijuid">
<h3 class='single-strong'>无需安装任何插件<font color='#ff6651'><?php echo $aik[dbts]?></font></h3>
<div class="top-list-ji">
    <h2 class="title g-clear"><em class="a-bigsite a-bigsite-leshi"></em></h2>
    <div class="ji-tab-content js-tab-content" style="opacity:1;">
        <?php
                $str = $data['data'][0]['vod_url'];
                $suArr = explode("$$$",$str);
                foreach($suArr as $a=>$b){  
                    $v = explode("\n",$b);
                    $d[] =$v; 
                }
                foreach($d as $k=>$v){    
                    foreach ($v as $cc){
                         $u = explode("$",$cc);
                        if(strpos($u[1] ,'.m3u8')){
                        $urls= $u[1];
                        $title= $u[0];
                        echo
                        '<a href="'.$urls.'" class="am-btn am-btn-default lipbtn">
                        '.$title.'
                        </a>';
                        }
                    }   
                }
?>


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
        if(mp4url.indexOf('m3u8')>=0){
            document.getElementById('video').src='./ck/index.php?url='+mp4url;
        };
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
