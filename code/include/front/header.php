<?php
    $page_name = substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
    
    if ($page_name == 'index.php' or $page_name == 'article.php' or $page_name == 'doc.php') {
        define('ROOT_PATH', './');
    } else {
        define('ROOT_PATH', '../../');
    }
    
    require_once ROOT_PATH.'include/back/core.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
    
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no"/>
        <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
        <title><?php echo $title; ?></title>
        <meta name="keywords" content="<?php echo $keyword; ?>"/>
        <meta name="description" content="一切是那么的简约高效."/>
        <link rel="shortcut icon" type="image/x-icon" href="/include/front/image/favicon.ico"/>
        <!-- 引用css -->
        <link rel="stylesheet" type="text/css" href="<?php echo ROOT_PATH; ?>include/front/layui/css/layui.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ROOT_PATH; ?>include/front/css/popup.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ROOT_PATH; ?>include/front/css/nprogress.css"/>
        <!-- 引用js -->
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/layui/layui.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/jquery.pjax.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/nprogress.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/axios.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/popup.js"></script>
        <script type="text/javascript" src="<?php echo ROOT_PATH; ?>include/front/js/modular.js"></script>
        <!-- layui -->
        <script type="text/javascript">
            layui.use(['laydate', 'laypage', 'layer', 'table', 'carousel', 'upload', 'element', 'util'], function() {
                var layer = layui.layer
                ,util = layui.util;
                
                util.fixbar({
                    bar1: '&#xe676'
                    ,bar2: false
                    ,css: {right: 30, bottom: 100}
                    ,bgcolor: '#9F9F9F'
                    ,click: function(type){
                        if(type === 'bar1'){
                            window.open('http://www.lxh5068.com');
                        }
                    }
                });
            });
        </script>
        <!-- 百度统计 -->
        <script>
            var _hmt = _hmt || [];
            (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?4914b96046dccbb9ad302ef6e2abcb7b";
                var s = document.getElementsByTagName("script")[0]; 
                s.parentNode.insertBefore(hm, s);
            })();
        </script>
        <!-- 百度自动推送 -->
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
    </head>
    
    <body>
        <ul id="nav" class="layui-nav" lay-filter="navigation">
            <li id="index_button" class="layui-nav-item"><a href="/">首页</a></li>
            <li id="doc_button" class="layui-nav-item"><a href="/doc.php">文档</a></li>
            <li id="user_button" class="layui-nav-item">
                <a href="javascript:void(0);">用户</a>
                <dl class="layui-nav-child">
                    <dd><a id="state"></a></dd>
                    <dd><a id="qq_number"></a></dd>
                    <hr>
                    <dd><a href="javascript:void(0);" onclick="login()">登录</a></dd>
                    <dd><a href="javascript:void(0);" onclick="log_out()">退出</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="http://www.lxh5068.com">官方网站</a></li>
        </ul>
        
        <div style="padding-right: 30px; padding-left: 30px; margin-right: auto; margin-left: auto">
            <div id="container">
                <?php
                    if ($page_name != 'index.php' and $page_name != 'doc.php') {
                        echo '
                            <div class="layui-bg-gray" style="margin-top: 30px; padding: 10px">
                                <div class="layui-row layui-col-space10">
                        ';
                    }
                ?>