<?php
$install = true;
require_once('../includes/common.php');
@header('Content-Type: text/html; charset=UTF-8');
if ($conf['version'] == NULL) {
    $sqls = file_get_contents('update1.sql');
    $version = 2001;
}elseif($conf['version']<2002){
    $sqls = file_get_contents('update2.sql');
    $version = 2002;
}elseif($conf['version']<2004){
    $sqls = file_get_contents('update3.sql');
    $version = 2004;
}elseif($conf['version']<2005){
    $sqls = file_get_contents('update4.sql');
    $version = 2005;
}else{
	exit('你的网站已经升级到最新版本了');
}
$explode = explode(';', $sqls);
foreach ($explode as $sql) {
    if ($sql = trim($sql)) {
        $conn ->query($sql);
    }
}
exit("<script language='javascript'>alert('网站数据库升级完成！');window.location.href='../';</script>");
