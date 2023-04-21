<?php
/**
 * Created by PhpStorm.
 * User: Hcw3.cn
 * Date: 11/11/2018
 * Time: 11:45 AM
 */

if (file_exists('./config.php')) {
    header('HTTP/1.0 403 Forbidden');
    die('Forbidden');
}


phpinfo();

