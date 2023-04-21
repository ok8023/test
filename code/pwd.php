<?php
include("includes/common.php");
$my = (isset($_GET['my']) ? $_GET['my'] : NULL);
if ($my == 'pwd') {
    if ($_GET['id'] == '') {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('禁止访问！');history.go(-1);</script>");
    }
    $pwd = daddslashes(strip_tags($_POST['pwd']));
    $id = daddslashes(strip_tags($_GET['id']));
    $rs = $conn->query("select * from url_list where id='$id'");
    if ($rs->num_rows == 0) {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('非法访问！');history.go(-1);</script>");
    }
    $rs = $conn->query("select * from url_list where id='$id' and pwd='$pwd'");
    if ($rs->num_rows == 0) {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('密码错误！');history.go(-1);</script>");
    }
    $res = $rs->fetch_assoc();
    $view = $res['view'] + 1;
    $conn->query("update url_list set view = '$view' where id = '$id'");
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if (strpos($ua, 'QQ/') && $res['qqjump'] != '') {
        header("Location: " . $res['qqjump'], true, 301);
    } elseif (strpos($ua, 'MicroMessenger') && $res['wxjump'] != '') {
        header("Location: " . $res['wxjump'], true, 301);
    } elseif (strpos($ua, 'AlipayClient') && $res['alijump'] != '') {
        header("Location: " . $res['alijump'], true, 301);
    } else {
        header("Location: " . $res['url'], true, 301);
    }
}
?>
<link rel="stylesheet" href="static/css/index.min.css">
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html {
        width: 100%;
        height: 100%;
        font-size: 16px;
    }

    body {
        width: 100%;
        height: 100%;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        -khtml-user-select: none;
        user-select: none;
    }

    .code {
        width: 400px;
        margin: 0 auto;
    }

    .input-val {
        width: 295px;
        background: #ffffff;
        height: 2.8rem;
        padding: 0 2%;
        border-radius: 5px;
        border: none;
        border: 1px solid rgba(0, 0, 0, .2);
        font-size: 1.0625rem;
    }

    #canvas {
        float: right;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn {
        width: 100px;
        height: 40px;
        background: #f1f1f1;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 20px auto 0;
        display: block;
        font-size: 1.2rem;
        color: #e22e1c;
        cursor: pointer;
    }
</style>
<script src="static/js/jquery.min.js"></script>
<div class="container code">
    <div class="text-center" style="padding-top:200px">
        <form action="pwd.php?id=<?php echo $_GET['id'] ?>&my=pwd" method="post">
            <input type="text" name="pwd" value="" placeholder="请输入访问密码" class="input-val" autofocus />
            <button class="btn">提交</button>
        </form>
    </div>
</div>