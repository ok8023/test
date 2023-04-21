<?php
if(!defined('IN_CRONLITE'))exit();

if(isset($_COOKIE["admin_token"]))
{
	$token=authcode(daddslashes($_COOKIE['admin_token']), 'DECODE', SYS_KEY);
	list($user, $sid) = explode("\t", $token);
	$session=md5($conf['admin_user'].$conf['admin_pwd'].$password_hash);
	if($session==$sid) {
		$islogin=1;
	}
}

if(isset($_COOKIE["user_token"]))
{
	$token=authcode(daddslashes($_COOKIE['user_token']), 'DECODE', SYS_KEY);
    list($id, $sid) = explode("\t", $token);
    $userrs = $conn->query("select * from user_list where id='".intval($id)."' limit 1");
	if($userrow=$userrs->fetch_assoc()){
		$session=md5($userrow['user'].$userrow['pwd'].$password_hash);
		if($session==$sid && $userrow['state']==1) {
			$islogin2=1;
		}
	}
}
?>