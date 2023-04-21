<?php
$rurl=curl_get($html);
$rurl = strstr($rurl, "<div monitor-desc='分页'") ;
$rurl = strstr($rurl, '</div>',TRUE) ;
$rurl = str_replace('http://www.360kan.com/dianying/',"?m=",$rurl);
echo $rurl;
?>