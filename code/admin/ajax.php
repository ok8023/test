<?php
include('../includes/common.php');
if (isset($_COOKIE['adminlogin'])) {
    $_SESSION['adminlogin'] = 1;
}
if ($_SESSION['adminlogin'] != 1) {
    exit('<script language=\'javascript\'>window.location.href=\'./login.php\';</script>');
}
$act = isset($_GET['act']) ? daddslashes($_GET['act']) : null;

@header('Content-Type: application/json; charset=UTF-8');
switch ($act) {
    case 'setUrl': //网址状态更改
        $id = intval($_GET['id']);
        $state = intval($_GET['state']);
        $rs = $conn->query("update url_list set state='$state' where id='{$id}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setUser': //用户状态更改
        $id = intval($_GET['id']);
        $state = intval($_GET['state']);
        $rs = $conn->query("update user_list set state='$state' where id='{$id}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'setNotice': //监控通知开关
        $id = intval($_GET['id']);
        $notice = intval($_GET['notice']);
        $rs = $conn->query("update url_safe set notice='$notice' where id='{$id}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'upTcn': //新浪短网址更新
        $id = intval($_GET['id']);
        $rs = $conn->query("select * from url_list where id = '$id'");
        $res = $rs->fetch_assoc();
        $url = 'http://' . $conf['domain'] . '/tz.php?id=' . $id;
        $tcn = tcn($url);
        $rs = $conn->query("update url_list set tcn='$tcn' where id='{$id}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'upUrlcn': //腾讯短网址更新
        $id = intval($_GET['id']);
        $rs = $conn->query("select * from url_list where id = '$id'");
        $res = $rs->fetch_assoc();
        $url = 'http://' . $conf['domain'] . '/tz.php?id=' . $id;
        $urlcn = urlcn($url);
        $rs = $conn->query("update url_list set urlcn='$urlcn' where id='{$id}'");
        exit('{"code":0,"msg":"succ"}');
        break;
    case 'getInfo': //查看网址详细信息
        $id = intval($_GET['id']);
        $rs = $conn->query("select * from url_list where id='$id' limit 1");
        if (!$rs)
            exit('{"code":-1,"msg":"当前网址不存在！"}');
        $res = $rs->fetch_assoc();
        if ($res['state'] == 1) {
            $state = '正常';
        } else {
            $state = '封禁';
        }
        $vrs = $conn->query("select * from visitors where urlid = '{$res["id"]}'");
        $viewNum = $vrs->num_rows;
        $result = array("code" => 0, "msg" => "succ", "id" => $res['id'], "uid" => $res['uid'], "setip" => $res['setip'], "state" => $state, "url" => $res['url'], "remarks" => $res['remarks'], "qqjump" => $res['qqjump'], "wxjump" => $res['wxjump'], "alijump" => $res['alijump'], "tcn" => $res['tcn'], "urlcn" => $res['urlcn'], "view" => $viewNum, "pwd" => $res['pwd'], "addtime" => $res['addtime']);
        exit(json_encode($result));
        break;
    case 'delSelect': //网址全选删除
        $id = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($id)) {
            $conn->query("delete from url_list where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'delSelect2': //监控全选删除
        $id = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($id)) {
            $conn->query("delete from url_safe where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'delSelect3': //用户全选删除
        $id = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($id)) {
            $conn->query("delete from user_list where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'noticeAll': //全选监控修改
        $notice = $_GET['notice'];
        $id = explode('&', $_POST['str']);
        $i = 0;
        while ($i < count($id)) {
            $conn->query("update url_safe set notice='$notice' where id = '$id[$i]'");
            $i++;
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
    case 'site':
        foreach ($_POST as $k => $value) {
            if ($k == 'pwd') continue;
            $value = daddslashes($value);
            $conn->query("insert into config set `k`='{$k}',`v`='{$value}' on duplicate key update `v`='{$value}'");
        }
        $result = array("code" => 0);
        exit(json_encode($result));
        break;
}
