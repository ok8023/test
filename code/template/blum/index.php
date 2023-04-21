<!DOCTYPE html>
<html class="no-js" lang="zh-CN">

<head>

    <title><?php echo $conf['web_name']; ?></title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $conf['description']; ?>">
    <meta name="keywords" content="<?php echo $conf['keywords']; ?>">

    <link rel="stylesheet" href="https://cdn.bootcss.com/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./static/blum/assets/css/style.css">
    <link rel="stylesheet" href="./static/blum/assets/css/utilities.css">

    <link rel="stylesheet" href="./static/blum/assets/css/custom.css">

    <link rel="stylesheet" href="https://cdn.bootcss.com/font-awesome/5.10.2/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="./static/blum/assets/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="./static/blum/assets/css/animate.min.css">
    <link rel="stylesheet" href="./static/blum/assets/css/vegas.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:200,300,300i,400,400i,700,700i%7CMontserrat:100,200,300,400,500,700">

    <link rel="shortcut icon" href="./static/picture/favicon.ico">

    <script src="./static/blum/assets/js/modernizr-custom.js"></script>



</head>

<body class="kenburns-background">

    <div id="preloader" class="preloader">
        <div class="loader-status">
            <div class="spinner"></div>
        </div>
    </div>

    <div class="global-overlay">
        <div class="overlay-inner bg-dark opacity-80"></div>
    </div>

    <header class="site-header header-mobile-dark header-content-light header-content-mobile-light">
        <div class="header-brand">
            <a class="logo" href="./">
                <img src="./static/picture/logo.png" alt="">
            </a>
            <button type="button" id="navigation-toggle" class="nav-toggle">
                <span></span>
            </button>
        </div>
        <div class="header-collapse">
            <div class="header-collapse-inner">
                <nav class="site-nav">
                    <ul id="navigation">
                        <li>
                            <a href="#home">首页</a>
                        </li>
                        <li>
                            <a href="#generate">短链生成</a>
                        </li>
                        <li>
                            <a href="#reduction">短链还原</a>
                        </li>
                        <li>
                            <a href="#about">免责申明</a>
                        </li>
                        <li>
                            <a href="./user">用户中心</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="site-content">
        <div class="site-content-inner">

            <div class="site-part" id="home">
                <section class="fullscreen d-flex">
                    <div class="container align-self-center text-white">
                        <div class="row">
                            <div class="col-12 col-lg-10 mx-lg-auto text-center">
                                <h1 class="text-white mb-3 animated" data-animation="fadeInUp">网址一键缩短还原</h1>
                                <p class="lead text-white mb-5 animated" data-animation="fadeInUp" data-animation-delay="200">解决网址过长的烦恼</p>
                                <a href="#generate" class="btn btn-white scrollto animated" data-animation="fadeInUp" data-animation-delay="400">短链生成</a>
                                <a href="#reduction" class="btn btn-primary scrollto animated" data-animation="fadeInUp" data-animation-delay="600">短链还原</a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="site-part" id="generate">
                <section class="fullscreen d-flex">
                    <div class="container align-self-center text-white">
                        <div class="row mb-5 text-center">
                            <div class="col-12 col-lg-9 mx-lg-auto">
                                <h2 class="h1 mb-4 animated" data-animation="fadeInUp">短网址生成</h2>
                                <div class="divider animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
                                <p class="animated" data-animation="fadeInUp" data-animation-delay="400">填入带http/https的网址，点击按钮生成短网址</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mx-lg-auto">
                                <div class="subscribe-form animated" data-animation="fadeInUp" data-animation-delay="600">

                                    <div class="form-row">

                                        <div class="form-process"></div>

                                        <div class="col-12 col-md-9">
                                            <div class="form-group text-white">
                                                <input type="url" id="dwz-kw" name="dwz-kw" placeholder="http://www.baidu.com" class="form-control required">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <button class="btn btn-primary btn-block" type="submit" id="dwz-btn" name="dwz-btn">生成</button>
                                        </div>

                                    </div>

                                    <div class="center-block" id="dwzdate" style="padding: 15px; border: 1px solid transparent;margin-bottom: 20px;margin-top: 20px;background: rgba(132, 131, 137, 0.67); color: #FFF; font-size:16px;text-align:center;display:none;"></div>
                                    <div class="subscribe-form-result pt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="site-part" id="reduction">
                <section class="fullscreen d-flex">
                    <div class="container align-self-center text-white">
                        <div class="row mb-5 text-center">
                            <div class="col-12 col-lg-9 mx-lg-auto">
                                <h2 class="h1 mb-4 animated" data-animation="fadeInUp">短网址还原</h2>
                                <div class="divider animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
                                <p class="animated" data-animation="fadeInUp" data-animation-delay="400">填入需要还原的短网址，还原真实的链接</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6 mx-lg-auto">
                                <div class="subscribe-form animated" data-animation="fadeInUp" data-animation-delay="600">
                                    <div class="form-row">

                                        <div class="form-process"></div>

                                        <div class="col-12 col-md-9">
                                            <div class="form-group text-white">
                                                <input type="url" id="dwz2-kw" name="dwz2-kw" placeholder="http://t.cn/Ai1omwJ0" class="form-control required">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-3">
                                            <button class="btn btn-primary btn-block" type="submit" id="dwz-btn2" name="dwz-btn2">还原</button>
                                        </div>

                                    </div>
                                    <div class="center-block" id="dwzdate2" style="padding: 15px; border: 1px solid transparent;margin-bottom: 20px;margin-top: 20px;background: rgba(132, 131, 137, 0.67); color: #FFF; font-size:16px;text-align:center;display:none;"></div>
                                    <div class="subscribe-form-result pt-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="site-part" id="about">
                <section class="fullscreen d-flex">
                    <div class="container align-self-center text-white">
                        <div class="row">
                            <div class="col-12 col-lg-10 mx-lg-auto text-center">
                                <h2 class="h1 mb-4 animated" data-animation="fadeInUp">免责申明</h2>
                                <div class="divider animated" data-animation="fadeInUp" data-animation-delay="200"><span></span></div>
                                <div class="animated" data-animation="fadeInUp" data-animation-delay="400">
                                    <p>本站禁止赌博、色情、暴力、诈骗等违法违规内容、支付页面或未经备案的网站生成的短网址，如有发现立即封停！</p>
                                    <p>本站仅提供待统计的短网址服务，短网址由用户生成，所有跳转的网站内容均与本站无关，访客请自行记录并核对跳转后的网站，谨防受骗！小勋源码网xxunym.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>
    </div>

    <!-- Site footer -->
    <!-- <footer class="site-footer footer-content-light footer-mobile-content-light">
        <div class="overlay">
            <div class="overlay-inner bg-white"></div>
        </div>
        <div class="container socials-container">
            <nav class="socials-icons">
                <ul class="mx-auto">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                </ul>
            </nav>
        </div>
        <div class="container copyright-container">
            <p>© 2019 5G云短网址 - All Rights Reserved</p>
        </div>
    </footer> -->

    <script src="https://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="./static/blum/assets/js/jquery.easing.min.js"></script>
    <script src="./static/blum/assets/js/jquery.validate.min.js"></script>
    <script src="./static/blum/assets/js/jquery.countdown.min.js"></script>
    <script src="./static/blum/assets/js/granim.min.js"></script>
    <script src="./static/blum/assets/js/vegas.min.js"></script>
    <script src="./static/blum/assets/js/jquery.mb.YTPlayer.min.js"></script>

    <script src="./static/blum/assets/js/main.js"></script>

    <script>
        $(document).ready(function() {
            $('#dwz-btn').click(function() {
                $("#dwzdate").hide();
                var url = $("input[id='dwz-kw']").val();
                url = url.replace(/\+/g, "%2B");
                url = url.replace(/\&/g, "%26");
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=creat1",
                    dataType: "json",
                    data: "url=" + url,
                    success: function(obj) {
                        if (obj.code == 0) {
                            $("#dwzdate").html(
                                '新浪短网址：' + obj.tcn + '<br />' +
                                '腾讯短网址：' + obj.urlcn + '<br />' +
                                '跳转网址：' + obj.url + '<br />' +
                                '<br /><img class="qrimg" src="https://api.btstu.cn/qrcode/api.php?size=200&text=' + obj.tzurl + '" />'
                            );
                            $("#dwzdate").slideDown();
                        } else if (obj.code == -1) {
                            $("#dwzdate").html(
                                obj.msg
                            );
                            $("#dwzdate").slideDown();
                        } else {
                            alert(obj.msg);
                        }
                    },
                    error: function(a) {
                        alert("失败！！");
                    }
                });
            });

            $('#dwz-btn2').click(function() {
                $("#dwzdate2").hide();
                var url = $("input[id='dwz2-kw']").val();
                url = url.replace(/\+/g, "%2B");
                url = url.replace(/\&/g, "%26");
                $.ajax({
                    type: "post",
                    url: "ajax.php?act=creat2",
                    dataType: "json",
                    data: "url=" + url,
                    success: function(obj) {
                        if (obj.code == 0) {
                            $("#dwzdate2").html(
                                '还原网址：' + obj.url + '<br />' +
                                '真实网址：' + obj.tzurl + '<br />' +
                                '<br /><img class="qrimg" src="https://api.btstu.cn/qrcode/api.php?size=200&text=' + obj.tzurl + '" />'
                            );
                            $("#dwzdate2").slideDown();
                        } else if (obj.code == -1) {
                            $("#dwzdate2").html(
                                obj.msg
                            );
                            $("#dwzdate2").slideDown();
                        } else {
                            alert(obj.msg);
                        }
                    },
                    error: function(a) {
                        alert("失败！！");
                    }
                });
            });
        });
    </script>
</body>

</html>