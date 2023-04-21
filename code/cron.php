<?php
include("./includes/common.php");
@header('Content-Type: text/html; charset=UTF-8');
if (empty($conf['cronkey'])) exit("请先设置好监控密钥");
if ($conf['cronkey'] != $_GET['key']) exit("监控密钥不正确");

elseif ($_GET['do'] == 'safe') {
    $rs = $conn->query("select * from url_safe");
    while ($res = $rs->fetch_array()) {
        $str = qqsafe($res['url']);
        if ($str['code'] == 202) {
            if ($res['safe'] == 1) {
                $conn->query("update url_safe set safe = 0 where id = '{$res['id']}'");
                if ($res['notice'] == 1) {
                    $urs = $conn->query("select * from user_list where id = '{$res['uid']}' limit 1");
                    $urow = $urs->fetch_assoc();
                    send_mail($urow['mail'], '安全监控通知', '您的网址' . $res['url'] . '已被关进小黑屋');
                }
            }
        } else {
            if ($res['safe'] == 0) {
                $conn->query("update url_safe set safe = 1 where id = '{$res['id']}'");
            }
        }
    }
    echo 'success';
}
