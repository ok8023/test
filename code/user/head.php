<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="../static/user/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/user/css/bootstrap-reset.css" rel="stylesheet">
    <link href="../static/user/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
    <link href="../static/user/css/style.css" rel="stylesheet">
    <link href="../static/user/css/style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="../static/preview-photo/preview-photo.css">
    <script src="../static/user/js/jquery.js"></script>
    <script src="../static/user/js/bootstrap.min.js"></script>
    <script src="../static/user/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="https://cdn.staticfile.org/layer/2.3/layer.js"></script>
    <script type="text/javascript" src="../static/preview-photo/preview-photo.js"></script>
</head>
<?php
if ($userrow['state'] == 0) {
    sysmsg('你的账号已被封禁！', true);
    exit;
}
?>

<body>
    <section id="container" class="">
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="收缩/展开" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <a href="./" class="logo">用户<span>中心</span></a>

            <div class="top-nav ">
                <ul class="nav pull-right top-menu">
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="<?php echo qq_img($userrow['qq'])['imgurl'] ?>" width="29px" height="29px">
                            <span class="username"><?php echo $userrow['user'] ?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="./urllist.php?my=add"><i class="icon-plus"></i>添加网址</a></li>
                            <li><a href="./uset.php?mod=user"><i class="icon-cog"></i> 资料修改</a></li>
                            <li><a href="./safelist.php?my=add"><i class="icon-eye-open"></i> 添加监控</a></li>
                            <li><a href="./login.php?my=logout"><i class="icon-key"></i> 登出</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <ul class="sidebar-menu">
                    <li class="<?php if ($active == 'index') {
                                    echo 'active';
                                } ?>">
                        <a class="" href="./">
                            <i class="icon-home"></i>
                            <span>用户首页</span>
                        </a>
                    </li>
                    <li class="sub-menu <?php if ($active == 'urllist-add' || $active == 'urllist') {
                                            echo 'active';
                                        } ?>">
                        <a href="javascript:;" class="">
                            <i class="icon-book"></i>
                            <span>网址管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="<?php if ($active == 'urllist-add') {
                                            echo 'active';
                                        } ?>"><a class="" href="./urllist.php?my=add">添加网址</a></li>
                            <li class="<?php if ($active == 'urllist') {
                                            echo 'active';
                                        } ?>"><a class="" href="./urllist.php">网址列表</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu <?php if ($active == 'safelist-add' || $active == 'safelist') {
                                            echo 'active';
                                        } ?>">
                        <a href="javascript:;" class="">
                            <i class="icon-eye-open"></i>
                            <span>监控管理</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="<?php if ($active == 'safelist-add') {
                                            echo 'active';
                                        } ?>"><a class="" href="./safelist.php?my=add">添加监控</a></li>
                            <li class="<?php if ($active == 'safelist') {
                                            echo 'active';
                                        } ?>"><a class="" href="./safelist.php">监控列表</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu <?php if ($active == 'uset-user') {
                                            echo 'active';
                                        } ?>">
                        <a href="javascript:;" class="">
                            <i class="icon-cogs"></i>
                            <span>系统设置</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li class="<?php if ($active == 'uset-user') {
                                            echo 'active';
                                        } ?>"><a class="" href="./uset.php?mod=user">资料修改</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="" href="./login.php?my=logout">
                            <i class="icon-signout"></i>
                            <span>退出登录</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>


</body>

</html>