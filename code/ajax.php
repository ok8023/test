<?php
include("includes/common.php");
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;
header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'creat1':
        if ($islogin2 != 1) {
            $uid = $conf['uid'];
        } else {
            $uid = $userrow['id'];
        }
        if ($_REQUEST['url'] == "") {
            exit('{"code":-1,"msg":"请填写需要缩短的网址"}');
        }
        $id = getCode(7);
        $ip = $_SERVER["REMOTE_ADDR"];
        $url = $_REQUEST['url'];
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            exit('{"code":-1,"msg":"请填写正确的网址"}');
        }
        $rs = $conn->query("select * from url_list where url='$url' and setip='$ip'");
        if ($rs->num_rows == 0) {
            if($conf['is_https']==1){
                $tzurl = 'https://' . $conf['domain'] . '/tz.php?id=' . $id;
            }else{
                $tzurl = 'http://' . $conf['domain'] . '/tz.php?id=' . $id;
            }
            $tcn = tcn($tzurl);
            $urlcn = urlcn($tzurl);
            $sql = "insert into url_list(id,uid,addtime,tcn,urlcn,url,setip) values('$id','$uid','$nowDate','$tcn','$urlcn','$url','$ip')";
            $rs = $conn->query($sql);
            $result = array("code" => 0, "tcn" => $tcn, "urlcn" => $urlcn, "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        } else {
            $res = $rs->fetch_assoc();
            if($conf['is_https']==1){
                $tzurl = 'https://' . $conf['domain'] . '/tz.php?id=' . $id;
            }else{
                $tzurl = 'http://' . $conf['domain'] . '/tz.php?id=' . $id;
            }
            $result = array("code" => 0, "tcn" => $res['tcn'], "urlcn" => $res['urlcn'], "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        }
        break;
    case 'creat2':
        if ($_REQUEST['url'] == "") {
            exit('{"code":-1,"msg":"请填写需要还原的网址"}');
        }
        $url = $_REQUEST['url'];
        $preg = "#^http(s)?://(www.)?(\w+(\.)?)+#";
        if (!preg_match($preg, $url)) {
            exit('{"code":-1,"msg":"请填写正确的网址"}');
        }
        $rs = $conn->query("select * from url_list where tcn='$url' or urlcn='$url'");
        if ($rs->num_rows > 0) {
            $res = $rs->fetch_assoc();
            $tzurl = $res['url'];
            $result = array("code" => 0, "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        } else {
            $tzurl = rurl($url);
            $result = array("code" => 0, "url" => $url, "tzurl" => $tzurl);
            exit(json_encode($result));
        }
}
