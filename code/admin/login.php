<?php
require_once('../includes/common.php');
if (isset($_POST['user']) && isset($_POST['pass'])) {
	$user = trim($_POST['user']);
	$pass = trim($_POST['pass']);
	if ($user == $conf['admin_user'] && $pass == $conf['admin_pwd']) {
		$_SESSION['adminlogin'] = 1;
		setcookie('adminlogin', time() + 7 * 24 * 60 * 60);
		log_result('后台登录', 'ip:' . $clientip, '登录成功');
		exit("<script language='javascript'>alert('登录管理中心成功！');window.location.href='./';</script>");
	} else {
		@header('Content-Type: text/html; charset=UTF-8');
		exit("<script language='javascript'>alert('用户名或密码不正确！');history.go(-1);</script>");
	}
} elseif (isset($_GET['logout'])) {
	unset($_SESSION['adminlogin']);
	setcookie('adminlogin', '', time() - 604800);
	@header('Content-Type: text/html; charset=UTF-8');
	exit("<script language='javascript'>alert('您已成功注销本次登陆！');window.location.href='./login.php';</script>");
} else if (isset($_SESSION['adminlogin']) == 1) {
	exit("<script language='javascript'>alert('您已登录！');window.location.href='./';</script>");
}
?>
<!DOCTYPE html>
<html lang="zh-CN">

<head>
	<title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../static/admin/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="../static/admin/login/css/main.css">
	<link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css">
</head>

<body>
	<div class="login">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../static/admin/login/picture/img-01.png" alt="IMG">
				</div>

				<form action="./login.php" class="login100-form validate-form" method="POST">
					<span class="login100-form-title">登录</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="user" placeholder="账号" required="required" maxlength="13" id="uid" onblur="input_uid()" />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" name="pass" placeholder="密码" required="required" maxlength="20" id="pwd" onblur="input_pwd()" />
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">登陆</button>
					</div>

					<div class="text-center p-t-12">
						<span id="msg" style="color:red;"> </span>
					</div>

					<div class="text-center p-t-136"></div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>