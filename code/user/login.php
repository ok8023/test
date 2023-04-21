﻿<?php
include('../includes/common.php');
$my = (isset($_GET['my']) ? $_GET['my'] : NULL);

if ($my == 'login') {
  if (isset($_POST['user']) && isset($_POST['pwd'])) {
    $user = daddslashes(strip_tags($_POST['user']));
    $pwd = daddslashes(strip_tags($_POST['pwd']));
    $rs = $conn->query("select * from user_list where (user = '$user' or qq = '$user') and pwd = '$pwd'");
    $row = $rs->fetch_assoc();
    if ($row && $user == $row['user'] && $pwd == $row['pwd']) {
      if ($row['state'] == 0) {
        @header('Content-Type: text/html; charset=UTF-8');
        exit("<script language='javascript'>alert('当前账号已被封禁！');history.go(-1);</script>");
      }
      $id = $row['id'];
      $conn->query("update user_list set lasttime = '$nowDate' where id = '$id'");
      $session = md5($user . $pwd . $password_hash);
      $token = authcode("{$id}\t{$session}", 'ENCODE', SYS_KEY);
      setcookie("user_token", $token, time() + 604800, '/');
      log_result('用户登录','id:'.$id.',ip:'.$clientip,'登录成功');
      exit("<script language='javascript'>alert('登录成功！');window.location.href='./';</script>");
    } else {
      @header('Content-Type: text/html; charset=UTF-8');
      exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
    }
  }
} elseif ($my == 'logout') {
  setcookie("user_token", "", time() - 604800, '/');
  @header('Content-Type: text/html; charset=UTF-8');
  exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
}
if ($islogin2 == 1) {
  exit("<script language='javascript'>alert('您已登陆！');window.location.href='./';</script>");
}
?>


<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <title>登录 | <?php echo $conf['web_name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../static/user/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="../static/user/css/style.css" type="text/css" />
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="login-body">
  <div class="container">
    <form class="form-signin" method="post" action="./login.php?my=login">
      <h2 class="form-signin-heading">用户登录</h2>
      <div class="login-wrap">
        <input type="text" name="user" class="form-control" placeholder="账号/QQ号" autofocus required />
        <input type="password" name="pwd" class="form-control" placeholder="密码" required />
        <label class="checkbox">
          <span class="pull-right" style="padding-bottom:15px"> <a href="./reg.php"> 注册账号</a> |<a href="./findpwd.php"> 找回密码</a></span>
        </label>
        <button class="btn btn-lg btn-login btn-block" type="submit">登 录</button>
      </div>
    </form>
  </div>
</body>

</html>