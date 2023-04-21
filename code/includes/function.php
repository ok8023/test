<?php
function sysmsg($msg = '未知的异常', $die = true)
{
    ?>
    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>站点提示信息</title>
        <style type="text/css">
            html {
                background: #eee
            }

            body {
                background: #fff;
                color: #333;
                font-family: "微软雅黑", "Microsoft YaHei", sans-serif;
                margin: 2em auto;
                padding: 1em 2em;
                max-width: 700px;
                -webkit-box-shadow: 10px 10px 10px rgba(0, 0, 0, .13);
                box-shadow: 10px 10px 10px rgba(0, 0, 0, .13);
                opacity: .8
            }

            h1 {
                border-bottom: 1px solid #dadada;
                clear: both;
                color: #666;
                font: 24px "微软雅黑", "Microsoft YaHei", , sans-serif;
                margin: 30px 0 0 0;
                padding: 0;
                padding-bottom: 7px
            }

            #error-page {
                margin-top: 50px
            }

            h3 {
                text-align: center
            }

            #error-page p {
                font-size: 9px;
                line-height: 1.5;
                margin: 25px 0 20px
            }

            #error-page code {
                font-family: Consolas, Monaco, monospace
            }

            ul li {
                margin-bottom: 10px;
                font-size: 9px
            }

            a {
                color: #21759B;
                text-decoration: none;
                margin-top: -10px
            }

            a:hover {
                color: #D54E21
            }

            .button {
                background: #f7f7f7;
                border: 1px solid #ccc;
                color: #555;
                display: inline-block;
                text-decoration: none;
                font-size: 9px;
                line-height: 26px;
                height: 28px;
                margin: 0;
                padding: 0 10px 1px;
                cursor: pointer;
                -webkit-border-radius: 3px;
                -webkit-appearance: none;
                border-radius: 3px;
                white-space: nowrap;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0, 0, 0, .08);
                box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0, 0, 0, .08);
                vertical-align: top
            }

            .button.button-large {
                height: 29px;
                line-height: 28px;
                padding: 0 12px
            }

            .button:focus,
            .button:hover {
                background: #fafafa;
                border-color: #999;
                color: #222
            }

            .button:focus {
                -webkit-box-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
                box-shadow: 1px 1px 1px rgba(0, 0, 0, .2)
            }

            .button:active {
                background: #eee;
                border-color: #999;
                color: #333;
                -webkit-box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
                box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5)
            }

            table {
                table-layout: auto;
                border: 1px solid #333;
                empty-cells: show;
                border-collapse: collapse
            }

            th {
                padding: 4px;
                border: 1px solid #333;
                overflow: hidden;
                color: #333;
                background: #eee
            }

            td {
                padding: 4px;
                border: 1px solid #333;
                overflow: hidden;
                color: #333
            }
        </style>
    </head>

    <body id="error-page">
        <?php echo '<h3>站点提示信息</h3>';
            echo $msg; ?>
    </body>

    </html>
    <?php
        if ($die == true) {
            exit;
        }
    }

    function tcn($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.btstu.cn/tcn/api.php?url=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $url = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($url, true);
        if ($str['code'] == 200) {
            $msg = $str['shorturl'];
        } else {
            $msg = '生成失败！';
        }
        return $msg;
    }

    function urlcn($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.btstu.cn/urlcn/api.php?url=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $url = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($url, true);
        if ($str['code'] == 200) {
            $msg = $str['shorturl'];
        } else {
            $msg = '生成失败！';
        }
        return $msg;
    }

    function rurl($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.btstu.cn/tcn/api.php?type=long&url=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $url = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($url, true);
        if ($str['code'] == 200) {
            $msg = $str['longurl'];
        } else {
            $msg = '还原失败！';
        }
        return $msg;
    }

    //生成随机码
    function getCode($len = 7)
    {
        global $conn;
        $str = "0123456789";
        $strlen = strlen($str);
        $randstr = "";
        for ($i = 0; $i < $len; $i++) {
            $randstr .= $str[mt_rand(0, $strlen - 1)];
        }
        $randstr = '1' . $randstr;
        $rs = $conn->query("select * from url_list where id='$randstr'");
        if ($rs->num_rows > 0) {
            getCode($len);
        } else {
            return $randstr;
        }
    }

    function daddslashes($string)
    {
        if (!is_array($string)) return addslashes($string);
        foreach ($string as $key => $val) $string[$key] = daddslashes($val);
        return $string;
    }

    function showmsg($content = '未知的异常', $type = 4, $back = false)
    {
        switch ($type) {
            case 1:
                $panel = "success";
                break;
            case 2:
                $panel = "info";
                break;
            case 3:
                $panel = "warning";
                break;
            case 4:
                $panel = "danger";
                break;
        }

        echo '<div class="panel panel-' . $panel . '">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
        echo $content;

        if ($back) {
            echo '<hr/><a href="' . $back . '"><< 返回上一页</a>';
        } else
            echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';

        echo '</div>
    </div>';
    }

    //QQ报毒检测
    function qqsafe($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.btstu.cn/qqsafe/api.php?domain=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $url = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($url, true);
        return $str;
    }

    //微信报毒检测
    function wxsafe($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.btstu.cn/wxsafe/api.php?domain=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $url = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($url, true);
        return $str;
    }

    function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0)
    {
        $ckey_length = 4;
        $key = md5($key ? $key : ENCRYPT_KEY);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        $result = '';
        $box = range(0, 255);
        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }

    function getUpdate()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://dwz.btstu.cn/dwz/index.php');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $str = curl_exec($ch);
        curl_close($ch);
        $str = json_decode($str, true);
        return $str;
    }

    function send_mail($to, $sub, $msg)
    {
        global $conf;
        include_once ROOT . 'includes/smtp.class.php';
        $From = $conf['mail_name'];
        $Host = $conf['mail_smtp'];
        $Port = $conf['mail_port'];
        $SMTPAuth = 1;
        $Username = $conf['mail_name'];
        $Password = $conf['mail_pwd'];
        $Nickname = $conf['web_name'];
        $SSL = $conf['mail_port'] == 465 ? 1 : 0;
        $mail = new SMTP($Host, $Port, $SMTPAuth, $Username, $Password, $SSL);
        $mail->att = array();
        if ($mail->send($to, $From, $sub, $msg, $Nickname)) {
            return true;
        } else {
            return $mail->log;
        }
    }

    function log_result($action, $param, $result)
    {
        global $conn;
        $nowDate = date("Y-m-d H:i:s");
        $conn->query("insert into log_list(action,param,result,addtime) values('$action','$param','$result','$nowDate')");
    }

    function qq_img($qq)
    {
        $result = file_get_contents("https://api.btstu.cn/qqxt/api.php?qq=" . $qq);
        $qqInfo = json_decode($result, true);
        return $qqInfo;
    }

    function getWeek($time)
    {
        $weekarray = array("日", "一", "二", "三", "四", "五", "六");
        $str =  "周" . $weekarray[date("w", strtotime("-" . $time . " day"))];
        return $str;
    }
    ?>