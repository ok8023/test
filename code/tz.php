<?php
include("includes/common.php");
if (!isset($_REQUEST['id'])) {
    header("Location: " . $conf['jump_1'], true, 301);
}
$id = $_REQUEST['id'];
$rs = $conn->query("select * from url_list where id = '$id'");
if ($rs->num_rows > 0) {
    $res = $rs->fetch_assoc();
    if ($res['state'] == 0) {
        exit("<script language='javascript'>alert('该网址已被封禁，请联系管理员！');window.location.href='" . $conf['jump_2'] . "';</script>");
    }
    if ($res['pwd'] == '') {
        $uid = $res['uid'];
        $urlid = $res['id'];
        $browser = getBroswer();
        $getip = GetIps();
        $froms = getIpFrom($ip)[0];
        $getos = getOs();
        $sourceLink = $_SERVER["HTTP_REFERER"];
        $pageview = $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"];
        echo $broswer;
        $conn->query("insert into visitors(uid,urlid,ip,froms,addtime,system,pageview,source_link,browser) values('$uid','$urlid','$getip','$froms','$nowDate','$getos','$pageview','$sourceLink','$browser')");
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
    } else {
        header("Location: ./pwd.php?id=" . $res['id']);
    }
} else {
    header("Location: " . $conf['jump_3'], true, 301);
}
