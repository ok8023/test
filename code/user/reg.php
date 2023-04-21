﻿<?php
include('../includes/common.php');
if ($conf['is_reg'] == 0) {
  exit("<script language='javascript'>alert('注册通道已关闭');history.go(-1);</script>");
}
$my = (isset($_GET['my']) ? $_GET['my'] : NULL);
if ($my == 'reg') {
  $user = daddslashes(strip_tags($_POST['user']));
  $pwd = daddslashes(strip_tags($_POST['pwd']));
  $pwds = daddslashes(strip_tags($_POST['pwds']));
  $qq = daddslashes(strip_tags($_POST['qq']));
  if ($user == '' || $pwd == '' || $pwds == '' || $qq == '') {
    exit("<script language='javascript'>alert('填写的信息不完整！');history.go(-1);</script>");
  }
  if ($pwd != $pwds) {
    exit("<script language='javascript'>alert('俩次输入的密码不一致！');history.go(-1);</script>");
  }
  if (!preg_match('/[a-zA-Z0-9_]{5,10}$/', $user)) {
    exit("<script language='javascript'>alert('账号格式有误');history.go(-1);</script>");
  }
  if (!preg_match('/\w{5,12}$/', $pwd)) {
    exit("<script language='javascript'>alert('密码格式有误');history.go(-1);</script>");
  }
  if (!preg_match('/^[0-9]{5,11}+$/', $qq)) {
    exit("<script language='javascript'>alert('QQ格式不正确！');history.go(-1);</script>");
  }
  $rs = $conn->query("select * from user_list where user='$user'");
  if ($rs->num_rows > 0) {
    exit("<script language='javascript'>alert('该用户名已存在！');history.go(-1);</script>");
  }
  $rs = $conn->query("select * from user_list where qq='$qq'");
  if ($rs->num_rows > 0) {
    exit("<script language='javascript'>alert('该QQ号已经注册过了！');history.go(-1);</script>");
  }
  $rs = $conn->query("insert into user_list(user,pwd,addtime,power,qq) values('$user','$pwd','$nowDate',0,'$qq')");
  if ($rs) {
    exit("<script language='javascript'>alert('注册成功');window.location.href='./login.php';</script>");
  } else {
    exit("<script language='javascript'>alert('注册失败！');history.go(-1);</script>");
  }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
  <meta charset="utf-8" />
  <title>用户注册 | <?php echo $conf['web_name'] ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="../static/user/css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="../static/user/css/style.css" type="text/css" />
  <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body class="login-body">
  <div class="container">
    <form class="form-signin" method="post" action="./reg.php?my=reg">
      <h2 class="form-signin-heading">用户注册</h2>
      <div class="login-wrap">
        <input type="text" name="user" class="form-control" placeholder="请输入账号" autofocus required />
        <input type="password" name="pwd" class="form-control" placeholder="请输入密码" required />
        <input type="password" name="pwds" class="form-control" placeholder="请再次输入密码" required />
        <input type="text" name="qq" class="form-control" placeholder="请输入QQ" required />
        <label class="checkbox">
          <span class="pull-right" style="padding-bottom:15px"> <a href="./login.php"> 返回登录</a> |<a href="./findpwd.php"> 找回密码</a></span>
        </label>
        <button class="btn btn-lg btn-login btn-block" type="submit">注 册</button>
      </div>
    </form>
  </div>
</body>

</html>