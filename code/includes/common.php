<?php
error_reporting(0);
define('SYSTEM_ROOT', dirname(__FILE__) . '/');
define('ROOT', dirname(SYSTEM_ROOT) . '/');
define('IN_CRONLITE',true);
date_default_timezone_set('Asia/Shanghai');
$scriptpath = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
$sitepath = substr($scriptpath, 0, strrpos($scriptpath, '/'));
$siteurl = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $sitepath . '/';
require SYSTEM_ROOT . '../config.php';
require SYSTEM_ROOT . 'version.php';
if (!defined('SQLITE') && (!$username || !$password || !$dbname)) {
    header('Content-type:text/html;charset=utf-8');
    echo '你还没安装！<a href="../install/">点此安装</a>';
    exit();
}

if ($conn->query("select * from config where 1") == FALSE) {
    header('Content-type:text/html;charset=utf-8');
    echo ("<script language='javascript'>alert('检查到你未安装数据库！点击确定安装');window.location.href='../install';</script>");
    exit();
}

$nowDate = date("Y-m-d H:i:s");
$clientip = $_SERVER["REMOTE_ADDR"];

$sql = "select * from config";
$result = $conn->query($sql);
while ($row = $result->fetch_array()) {
    $conf[$row['k']] = $row['v'];
}
if ($conf['domain'] == '') {
    $conf['domain'] = $_SERVER['SERVER_NAME'];
}

if ($conf['version'] < DB_VERSION) {
    if (!$install) {
        header('Content-type:text/html;charset=utf-8');
        echo '请先完成网站升级！<a href="/install/update.php"><font color=red>点此升级</font></a>';
        exit(0);
    }
}

$password_hash='!@#%!s!0';

require_once(SYSTEM_ROOT.'function.php');
require_once(SYSTEM_ROOT.'visitor.class.php');
require_once(SYSTEM_ROOT.'data.class.php');
include_once(SYSTEM_ROOT.'member.php');
session_start();
if (is_file(SYSTEM_ROOT . '360safe/360webscan.php')) { //360网站卫士
    require_once(SYSTEM_ROOT . '360safe/360webscan.php');
}

if (!file_exists(ROOT . "install/dwz") && file_exists(ROOT . "install/index.php")) {
    sysmsg("<h2>检测到无 dwz 文件</h2><ul><font size=\"4\">如果您尚未安装本程序，请<a href=\"/install/\">前往安装</a></font><font size=\"4\">如果您已经安装本程序，请手动放置一个空的 dwz 文件到 /install 文件夹下，<b>为了您站点安全，在您完成它之前我们不会工作。</b></font></li></ul><br/><h4>为什么必须建立 dwz 文件？</h4>它是程序的保护文件，如果检测不到它，就会认为站点还没安装，此时任何人都可以安装/重装程序。<br/><br/>", true);
}

if ($conf['web_cc'] == 1) {
    empty($_SERVER['HTTP_VIA']) or exit('Access Denied');
    $seconds = 10; //时间段[秒]
    $refresh = 20; //刷新次数

    //设置监控变量
    $cur_time = time();
    if (isset($_SESSION['last_time'])) {
        $_SESSION['refresh_times'] += 1;
    } else {
        $_SESSION['refresh_times'] = 1;
        $_SESSION['last_time'] = $cur_time;
    }

    //处理监控结果
    if ($cur_time - $_SESSION['last_time'] < $seconds) {
        if ($_SESSION['refresh_times'] >= $refresh) {
            //跳转验证
            $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $msg = '<center style="padding-top:100px;"><title>安全检查</title><h3>检测到CC攻击，正在进行浏览器安全检查！</h3></center>';
            exit($msg . "<meta http-equiv='refresh' content='3;url={$url}'>"); //3是定时跳转的时间，后期可以根据时间段调整跳转时间
        }
    } else {
        $_SESSION['refresh_times'] = 0;
        $_SESSION['last_time'] = $cur_time;
    }
}
