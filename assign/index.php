<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
//开启session
session_start();
//判断用户是否登录
if(@!$_SESSION['user']){
	_alert_back_url('请先登录','login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" charset="utf-8">
	<title>商丘工学院图书馆座位管理系统</title>
	<link rel="icon" href="favicon.jpg">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/contral_panel.css">
</head>
<body>
<!-- header -->
<?php require ROOT_PATH.'includes/header.inc.php';?>
<!-- header end -->

<!-- content -->
<?php require ROOT_PATH.'includes/left_index_file.inc.php';?>
<!-- content end -->
<!-- footer -->
<?php require ROOT_PATH.'includes/footer_file.inc.php';?>
<!-- end footer -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>