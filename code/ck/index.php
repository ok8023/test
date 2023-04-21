<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>M3U8视频解析P2P版</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
    <script src="jquery.js?v=3.1.5" type="text/javascript" charset="utf-8"></script>
    <script src="player.js?v=3.1.5" type="text/javascript" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="player.css?v=3.1.5" />
</head>
<body>
    <script type="text/javascript"> var play = {"auto":true,"live":false,"trys":"0","seek":"0","take":vfed.cookie.put("<?php echo($_REQUEST['url']);?>"),"urls":"<?php echo($_REQUEST['url']);?>","jump":"","logo":"","pics":"loading.gif"};</script>
    <div id="video" style="width:100%;height:100%"></div><div class="play"></div><div class="total"><span class="peer"></span><span class="load"></span><span class="line"></span></div>
    <link rel="stylesheet" type="text/css" href="dplayer.css?v=3.1.5" />
<script src="p2p.min.js?v=3.1.5" type="text/javascript" charset="utf-8"></script>
<script src="hls.min.js?v=3.1.5" type="text/javascript" charset="utf-8"></script>
<script src="dplayer.js?v=3.1.5" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">vfed.player.eplayer(play.auto, play.live, play.trys, play.seek, play.take, play.urls, play.jump, play.logo, play.pics);</script>
    <span style="display: none;"></span>
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>

<script language="javascript" type="text/javascript" src="http://js.users.51.la/18759442.js"></script>
</body>
</html>
