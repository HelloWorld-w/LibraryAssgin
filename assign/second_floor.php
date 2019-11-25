<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';
//开启session
session_start();
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
	<link rel="stylesheet" type="text/css" href="css/floor.css">
</head>
<body>
<!-- header -->
<?php require ROOT_PATH.'includes/header.inc.php';?>
<!-- header end -->

<!-- content -->
<div class="container-fluid" id="container-main">
	<div class="page-container">
		<!-- left content -->
			<?php require ROOT_PATH.'includes/left_file.inc.php';?>
		<!-- end left content -->

		<!-- right content -->
		<div class="page-content">
			<!-- content header -->
			<ol class="breadcrumb">
				<li><a href="index.php">控制面板</a></li>
				<li>二楼</li>
			</ol>
			<!-- end content header -->

			<!-- right content -->
			<div class="content-body">
				<!-- 展示台 -->
				<?php require ROOT_PATH.'includes/second_right_display_first.inc.php';?>
				<!-- 展示台end -->
			</div>
		</div>
		<!-- end right content -->
	</div>
</div>
<!-- content end -->
<!-- footer -->
<?php require ROOT_PATH.'includes/footer_file.inc.php';?>
<!-- end footer -->
<script type="text/javascript" src="js/alert.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/modal.js"></script>
</body>
</html>