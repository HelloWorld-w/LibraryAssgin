<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
session_start();
session_unset();
session_destroy();
_alert_back_url('您已退出登录','login.php');
?>