<?php
//获取浏览器信息
function getBroswer()
{
    $sys = $_SERVER['HTTP_USER_AGENT'];  //获取用户代理字符串
    if (stripos($sys, "Firefox/") > 0) {
        preg_match("/Firefox\/([^;)]+)+/i", $sys, $b);
        $exp[0] = "Firefox";
        $exp[1] = $b[1];  //获取火狐浏览器的版本号
    } elseif (stripos($sys, "Maxthon") > 0) {
        preg_match("/Maxthon\/([\d\.]+)/", $sys, $aoyou);
        $exp[0] = "傲游";
        $exp[1] = $aoyou[1];
    } elseif (stripos($sys, "Baiduspider") > 0) {
        $exp[0] = "百度";
        $exp[1] = '蜘蛛';
    } elseif (stripos($sys, "YisouSpider") > 0) {
        $exp[0] = "一搜";
        $exp[1] = '蜘蛛';
    } elseif (stripos($sys, "Googlebot") > 0) {
        $exp[0] = "谷歌";
        $exp[1] = '蜘蛛';
    } elseif (stripos($sys, "Android 4.3") > 0) {
        $exp[0] = "安卓";
        $exp[1] = '4.3';
    } elseif (stripos($sys, "MSIE") > 0) {
        preg_match("/MSIE\s+([^;)]+)+/i", $sys, $ie);
        $exp[0] = "IE";
        $exp[1] = $ie[1];  //获取IE的版本号
    } elseif (stripos($sys, "OPR") > 0) {
        preg_match("/OPR\/([\d\.]+)/", $sys, $opera);
        $exp[0] = "Opera";
        $exp[1] = $opera[1];
    } elseif (stripos($sys, "Edge") > 0) {
        //win10 Edge浏览器 添加了chrome内核标记 在判断Chrome之前匹配
        preg_match("/Edge\/([\d\.]+)/", $sys, $Edge);
        $exp[0] = "Edge";
        $exp[1] = $Edge[1];
    } elseif (stripos($sys, "Chrome") > 0) {
        preg_match("/Chrome\/([\d\.]+)/", $sys, $google);
        $exp[0] = "Chrome";
        $exp[1] = $google[1];  //获取google chrome的版本号
    } elseif (stripos($sys, 'rv:') > 0 && stripos($sys, 'Gecko') > 0) {
        preg_match("/rv:([\d\.]+)/", $sys, $IE);
        $exp[0] = "IE";
        $exp[1] = $IE[1];
    } else if (stripos($sys, 'AhrefsBot') > 0) {
        $exp[0] = "AhrefsBot";
        $exp[1] = '蜘蛛';
    } else if (stripos($sys, 'Safari') > 0) {
        preg_match("/([\d\.]+)/", $sys, $safari);
        $exp[0] = "Safari";
        $exp[1] = $safari[1];
    } else if (stripos($sys, 'bingbot') > 0) {
        $exp[0] = "必应";
        $exp[1] = '蜘蛛';
    } else if (stripos($sys, 'WinHttp') > 0) {
        $exp[0] = "windows";
        $exp[1] = 'WinHttp 请求接口工具';
    } else if (stripos($sys, 'iPhone OS 10') > 0) {
        $exp[0] = "iPhone";
        $exp[1] = 'OS 10';
    } else if (stripos($sys, 'Sogou') > 0) {
        $exp[0] = "搜狗";
        $exp[1] = '蜘蛛';
    } else if (stripos($sys, 'HUAWEIM') > 0) {
        $exp[0] = "华为";
        $exp[1] = '手机端';
    } else if (stripos($sys, 'Dalvik') > 0) {
        $exp[0] = "安卓";
        $exp[1] = 'Dalvik虚拟机';
    } else if (stripos($sys, 'Mac OS X 10') > 0) {
        $exp[0] = "MAC";
        $exp[1] = 'OS X10';
    } else if (stripos($sys, 'Opera/9.8') > 0) {
        $exp[0] = "Opera";
        $exp[1] = '9.8';
    } else if (stripos($sys, 'JikeSpider') > 0) {
        $exp[0] = "即刻";
        $exp[1] = '蜘蛛';
    } else if (stripos($sys, 'Baiduspider') > 0) {
        $exp[0] = "百度";
        $exp[1] = '蜘蛛';
    } else {
        $exp[0] = $sys;
        $exp[1] = "";
    }
    return $exp[0] . ' ' . $exp[1];
}


//获取操作系统信息
function getOs()
{
    $agent = $_SERVER['HTTP_USER_AGENT'];
    $os = false;

    if (preg_match('/win/i', $agent) && strpos($agent, '95')) {
        $os = 'Windows 95';
    } else if (preg_match('/win 9x/i', $agent) && strpos($agent, '4.90')) {
        $os = 'Windows ME';
    } else if (preg_match('/win/i', $agent) && preg_match('/98/i', $agent)) {
        $os = 'Windows 98';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.0/i', $agent)) {
        $os = 'Windows Vista';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.1/i', $agent)) {
        $os = 'Windows 7';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 6.2/i', $agent)) {
        $os = 'Windows 8';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 10.0/i', $agent)) {
        $os = 'Windows 10'; // 添加win10判断
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5.1/i', $agent)) {
        $os = 'Windows XP';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt 5/i', $agent)) {
        $os = 'Windows 2000';
    } else if (preg_match('/win/i', $agent) && preg_match('/nt/i', $agent)) {
        $os = 'Windows NT';
    } else if (preg_match('/win/i', $agent) && preg_match('/32/i', $agent)) {
        $os = 'Windows 32';
    } else if (preg_match('/linux/i', $agent)) {
        if (preg_match("/Mobile/", $agent)) {
            if (preg_match("/QQ/i", $agent)) {
                $os = "Android QQ Browser";
            } else {
                $os = "Android Browser";
            }
        } else {
            $os = 'PC-Linux';
        }
    } else if (preg_match('/Mac/i', $agent)) {
        if (preg_match("/Mobile/", $agent)) {
            if (preg_match("/QQ/i", $agent)) {
                $os = "IPhone QQ Browser";
            } else {
                $os = "IPhone Browser";
            }
        } else {
            $os = 'Mac OS X';
        }
    } else if (preg_match('/unix/i', $agent)) {
        $os = 'Unix';
    } else if (preg_match('/sun/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'SunOS';
    } else if (preg_match('/ibm/i', $agent) && preg_match('/os/i', $agent)) {
        $os = 'IBM OS/2';
    } else if (preg_match('/Mac/i', $agent) && preg_match('/PC/i', $agent)) {
        $os = 'Macintosh';
    } else if (preg_match('/PowerPC/i', $agent)) {
        $os = 'PowerPC';
    } else if (preg_match('/AIX/i', $agent)) {
        $os = 'AIX';
    } else if (preg_match('/HPUX/i', $agent)) {
        $os = 'HPUX';
    } else if (preg_match('/NetBSD/i', $agent)) {
        $os = 'NetBSD';
    } else if (preg_match('/BSD/i', $agent)) {
        $os = 'BSD';
    } else if (preg_match('/OSF1/i', $agent)) {
        $os = 'OSF1';
    } else if (preg_match('/IRIX/i', $agent)) {
        $os = 'IRIX';
    } else if (preg_match('/FreeBSD/i', $agent)) {
        $os = 'FreeBSD';
    } else if (preg_match('/teleport/i', $agent)) {
        $os = 'teleport';
    } else if (preg_match('/flashget/i', $agent)) {
        $os = 'flashget';
    } else if (preg_match('/webzip/i', $agent)) {
        $os = 'webzip';
    } else if (preg_match('/offline/i', $agent)) {
        $os = 'offline';
    } else {
        $os = '未知操作系统';
    }
    return $os;
}

//获取客户端真实IP
function getIps()
{
    $realip = '';
    $unknown = 'unknown';
    if (isset($_SERVER)) {
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($arr as $ip) {
                $ip = trim($ip);
                if ($ip != 'unknown') {
                    $realip = $ip;
                    break;
                }
            }
        } else if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)) {
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        } else if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $realip = $_SERVER['REMOTE_ADDR'];
        } else {
            $realip = $unknown;
        }
    } else {
        if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
            $realip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
            $realip = getenv("HTTP_CLIENT_IP");
        } else if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
            $realip = getenv("REMOTE_ADDR");
        } else {
            $realip = $unknown;
        }
    }
    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;
    return $realip;
}

function getIpFrom($ip = '')
{
    if (empty($ip)) {
        $ip = GetIps();
    }

    $res = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip);

    if ($res) {
        $json = json_decode($res, true);
    } else {
        $json = '';
    }

    $address[0] = $json['data']['country'] . $json['data']['region'] . $json['data']['city'] . $json['data']['isp'];
    $address[1] = $ip;

    return $address;
}

//24小时内访问统计
function statDay($urlid, $uid)
{
    global $conn;
    global $nowDate;

    $daytime1 = date("Y-m-d", strtotime("-1 day"));
    $hourtime1 = date("Y-m-d H:i:s", strtotime("-2 hour")); //2小时前
    $hourtime2 = date("Y-m-d H:i:s", strtotime("-4 hour")); //4小时前
    $hourtime3 = date("Y-m-d H:i:s", strtotime("-6 hour")); //6小时前
    $hourtime4 = date("Y-m-d H:i:s", strtotime("-8 hour")); //8小时前
    $hourtime5 = date("Y-m-d H:i:s", strtotime("-10 hour")); //10小时前
    $hourtime6 = date("Y-m-d H:i:s", strtotime("-12 hour")); //12小时前
    $hourtime7 = date("Y-m-d H:i:s", strtotime("-14 hour")); //14小时前
    $hourtime8 = date("Y-m-d H:i:s", strtotime("-16 hour")); //16小时前
    $hourtime9 = date("Y-m-d H:i:s", strtotime("-18 hour")); //18小时前
    $hourtime10 = date("Y-m-d H:i:s", strtotime("-20 hour")); //20小时前
    $hourtime11 = date("Y-m-d H:i:s", strtotime("-22 hour")); //22小时前
    $hourtime12 = date("Y-m-d H:i:s", strtotime("-24 hour")); //24小时前

    if ($urlid == 'all' && $uid != 'all') {
        $rs = $conn->query("select * from visitors where addtime >= '$daytime1' and uid ='$uid'");
        $dayVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime1' and addtime<'$nowDate' and uid = '$uid'");
        $hourVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime2' and addtime<'$hourtime1' and uid = '$uid'");
        $hourVit2 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime3' and addtime<'$hourtime2' and uid = '$uid'");
        $hourVit3 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime4' and addtime<'$hourtime3' and uid = '$uid'");
        $hourVit4 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime5' and addtime<'$hourtime4' and uid = '$uid'");
        $hourVit5 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime6' and addtime<'$hourtime5' and uid = '$uid'");
        $hourVit6 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime7' and addtime<'$hourtime6' and uid = '$uid'");
        $hourVit7 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime8' and addtime<'$hourtime7' and uid = '$uid'");
        $hourVit8 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime9' and addtime<'$hourtime8' and uid = '$uid'");
        $hourVit9 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime10' and addtime<'$hourtime9' and uid = '$uid'");
        $hourVit10 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime11' and addtime<'$hourtime10' and uid = '$uid'");
        $hourVit11 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime12' and addtime<'$hourtime11' and uid = '$uid'");
        $hourVit12 = $rs->num_rows;
    } elseif ($urlid != 'all' && $uid != 'all') {
        $rs = $conn->query("select * from visitors where addtime >= '$daytime1' and uid ='$uid' and urlid='$urlid'");
        $dayVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime1' and addtime<'$nowDate' and uid = '$uid' and urlid='$urlid'");
        $hourVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime2' and addtime<'$hourtime1' and uid = '$uid' and urlid='$urlid'");
        $hourVit2 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime3' and addtime<'$hourtime2' and uid = '$uid' and urlid='$urlid'");
        $hourVit3 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime4' and addtime<'$hourtime3' and uid = '$uid' and urlid='$urlid'");
        $hourVit4 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime5' and addtime<'$hourtime4' and uid = '$uid' and urlid='$urlid'");
        $hourVit5 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime6' and addtime<'$hourtime5' and uid = '$uid' and urlid='$urlid'");
        $hourVit6 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime7' and addtime<'$hourtime6' and uid = '$uid' and urlid='$urlid'");
        $hourVit7 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime8' and addtime<'$hourtime7' and uid = '$uid' and urlid='$urlid'");
        $hourVit8 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime9' and addtime<'$hourtime8' and uid = '$uid' and urlid='$urlid'");
        $hourVit9 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime10' and addtime<'$hourtime9' and uid = '$uid' and urlid='$urlid'");
        $hourVit10 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime11' and addtime<'$hourtime10' and uid = '$uid' and urlid='$urlid'");
        $hourVit11 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime12' and addtime<'$hourtime11' and uid = '$uid' and urlid='$urlid'");
        $hourVit12 = $rs->num_rows;
    } elseif ($urlid == 'all' && $uid == 'all') {
        $rs = $conn->query("select * from visitors where addtime >= '$daytime1'");
        $dayVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime1'");
        $hourVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime2'");
        $hourVit2 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime3'");
        $hourVit3 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime4'");
        $hourVit4 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime5'");
        $hourVit5 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime6'");
        $hourVit6 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime7'");
        $hourVit7 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime8'");
        $hourVit8 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime9'");
        $hourVit9 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime10'");
        $hourVit10 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime11'");
        $hourVit11 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime12'");
        $hourVit12 = $rs->num_rows;
    } else {
        $rs = $conn->query("select * from visitors where addtime >= '$daytime1' and and urlid='$urlid'");
        $dayVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime1' and addtime<'$nowDate' and urlid='$urlid'");
        $hourVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime2' and addtime<'$hourtime1' and urlid='$urlid'");
        $hourVit2 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime3' and addtime<'$hourtime2' and urlid='$urlid'");
        $hourVit3 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime4' and addtime<'$hourtime3' and urlid='$urlid'");
        $hourVit4 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime5' and addtime<'$hourtime4' and urlid='$urlid'");
        $hourVit5 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime6' and addtime<'$hourtime5' and urlid='$urlid'");
        $hourVit6 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime7' and addtime<'$hourtime6' and urlid='$urlid'");
        $hourVit7 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime8' and addtime<'$hourtime7' and urlid='$urlid'");
        $hourVit8 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime9' and addtime<'$hourtime8' and urlid='$urlid'");
        $hourVit9 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime10' and addtime<'$hourtime9' and urlid='$urlid'");
        $hourVit10 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime11' and addtime<'$hourtime10' and urlid='$urlid'");
        $hourVit11 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >='$hourtime12' and addtime<'$hourtime11' and urlid='$urlid'");
        $hourVit12 = $rs->num_rows;
    }

    $statDay = array($dayVit1, $hourVit1, $hourVit2, $hourVit3, $hourVit4, $hourVit5, $hourVit6, $hourVit7, $hourVit8, $hourVit9, $hourVit10, $hourVit11, $hourVit12);
    return $statDay;
}

function statWeek($urlid, $uid)
{
    global $conn;

    $today = date("Y-m-d");
    $day1 = date("Y-m-d", strtotime("-7 day"));
    $day2 = date("Y-m-d", strtotime("-6 day"));
    $day3 = date("Y-m-d", strtotime("-5 day"));
    $day4 = date("Y-m-d", strtotime("-4 day"));
    $day5 = date("Y-m-d", strtotime("-3 day"));
    $day6 = date("Y-m-d", strtotime("-2 day"));
    $day7 = date("Y-m-d", strtotime("-1 day"));

    $todaystart = $today . ' 00:00:00';
    $daystart1 = $day1 . ' 00:00:00';
    $daystart2 = $day2 . ' 00:00:00';
    $daystart3 = $day3 . ' 00:00:00';
    $daystart4 = $day4 . ' 00:00:00';
    $daystart5 = $day5 . ' 00:00:00';
    $daystart6 = $day6 . ' 00:00:00';
    $daystart7 = $day7 . ' 00:00:00';

    if ($urlid == 'all' && $uid != 'all') {
        $rs = $conn->query("select * from visitors where addtime >= '$daystart1' and addtime < '$todaystart' and uid = '$uid'");
        $allvit = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart1' and addtime < '$daystart2' and uid = '$uid'");
        $dayVit1 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart2' and addtime < '$daystart3' and uid = '$uid'");
        $dayVit2 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart3' and addtime < '$daystart4' and uid = '$uid'");
        $dayVit3 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart4' and addtime < '$daystart5' and uid = '$uid'");
        $dayVit4 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart5' and addtime < '$daystart6' and uid = '$uid'");
        $dayVit5 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart6' and addtime < '$daystart7' and uid = '$uid'");
        $dayVit6 = $rs->num_rows;
        $rs = $conn->query("select * from visitors where addtime >= '$daystart7' and addtime < '$todaystart' and uid = '$uid'");
        $dayVit7 = $rs->num_rows;
    }

    $statWeek = array(
        array($today, $allvit),
        array($day1, $dayVit1),
        array($day2, $dayVit2),
        array($day3, $dayVit3),
        array($day4, $dayVit4),
        array($day5, $dayVit5),
        array($day6, $dayVit6),
        array($day7, $dayVit7)
    );
    return $statWeek;
}
