<?php
function getTotal($t)
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

    $rs = $conn->query("select * from {$t} where addtime >= '$daystart1' and addtime < '$daystart2'");
    $num1 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart2' and addtime < '$daystart3'");
    $num2 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart3' and addtime < '$daystart4'");
    $num3 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart4' and addtime < '$daystart5'");
    $num4 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart5' and addtime < '$daystart6'");
    $num5 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart6' and addtime < '$daystart7'");
    $num6 = $rs->num_rows;
    $rs = $conn->query("select * from {$t} where addtime >= '$daystart7' and addtime < '$todaystart'");
    $num7 = $rs->num_rows;

    $statWeek = array(
        array($day1, $num1),
        array($day2, $num2),
        array($day3, $num3),
        array($day4, $num4),
        array($day5, $num5),
        array($day6, $num6),
        array($day7, $num7)
    );
    return $statWeek;
}
