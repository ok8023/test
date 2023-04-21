<?php
include ('./data/init.php');
$response=curl_get($html);
$response = strstr($response, '<dt class="type">类型:</dt>') ;
$response = strstr($response, '</dd>',TRUE) ;
$response = str_replace('<dt class="type">类型:</dt>',"",$response);
$response = str_replace('<b class="on">','<a class="active">',$response);
$response = str_replace('</b>','</a>',$response);
$response = str_replace('<dd class="item g-clear js-filter-content">',"",$response);
$response = str_replace('http://www.360kan.com/',"./index.php?mode=list&net=",$response);
echo $response;
?>