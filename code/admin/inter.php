<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
    $_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$mod = isset($_GET['mod']) ? $_GET['mod'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>系统设置</title>
    <link href="./static/css/bootstrap.min.css" rel="stylesheet">
    <link href="./static/css/bootstrap-reset.css" rel="stylesheet">
    <script src="./static/js/jquery.js"></script>
    <script src="./static/js/bootstrap.min.js"></script>
    <style>
        .img-responsive {
            display: block;
            height: auto;
            max-width: 100%;
        }
    </style>
</head>

<body>
    <?php
    $match = rand(1, 50);
    if ($mod == 'set_bg') {
        ?>
        <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;">
            <div class="panel-body">
                <form action="inter.php?mod=up_bg" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <br>
                    <button class="btn btn-primary btn-block">提交</button>
                </form>
                <br>
                <p>现在的背景：</p>
                <img src="../static/picture/bg.png?<?php echo $match ?>" class="img-responsive" alt="">
            </div>
        </div>
    <?php
    } elseif ($mod == 'up_bg') {
        ?>
        <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;padding-top:20px">
            <?php
                $file = $_FILES['file'];
                if (!is_uploaded_file($file['tmp_name'])) {
                    showmsg('上传失败,文件非法!', 3);
                }
                if (!in_array($file['type'], array('image/jpeg', 'image/gif', 'image/png'))) {
                    showmsg('上传失败，图片格式有误!', 3);
                }
                $uploadPath = '../static/picture/';
                $uploadUrl = '../static/picture/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath . $fileDir, 0777, true);
                }
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $bg = 'bg.png';
                $imgPath = $uploadPath . $bg;
                if (!move_uploaded_file($file['tmp_name'], $imgPath)) {
                    showmsg('服务器繁忙', 4);
                } else {
                    showmsg('上传成功！<br/><a href="set.php">>>返回系统设置</a>', 1);
                }
                ?>
        </div>
    <?php
    } elseif ($mod == 'set_logo') {
        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">网站公告配置</h3>
            </div>
            <div class="panel-body">
                <form action="inter.php?mod=up_logo" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                    <input type="file" name="file">
                    <br>
                    <button class="btn btn-primary btn-block">提交</button>
                </form>
                <br>
                <p>现在的logo：</p>
                <img src="../static/picture/logo.png?<?php echo $match ?>" class="img-responsive" alt="">
            </div>
        </div>
    <?php
    } elseif ($mod == 'up_logo') {
        ?>
        <div class="col-xs-12 col-sm-10 col-lg-8 center-block" style="float: none;padding-top:20px">
        <?php
            $file = $_FILES['file'];
            if (!is_uploaded_file($file['tmp_name'])) {
                showmsg('上传失败,文件非法!', 3);
            }
            if (!in_array($file['type'], array('image/jpeg', 'image/gif', 'image/png'))) {
                showmsg('上传失败，图片格式有误!', 3);
            }
            $uploadPath = '../static/picture/';
            $uploadUrl = '../static/picture/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath . $fileDir, 0777, true);
            }
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $bg = 'logo.png';
            $imgPath = $uploadPath . $bg;
            if (!move_uploaded_file($file['tmp_name'], $imgPath)) {
                showmsg('服务器繁忙', 4);
            } else {
                showmsg('上传成功！<br/><a href="set.php">>>返回系统设置</a>', 1);
            }
        }
        ?>
        </div>
        <?php
        ?>

</body>

</html>