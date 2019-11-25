<?php
//开启session
session_start();
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
_code();
?>