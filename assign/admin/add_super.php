<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
//开启session
session_start();
if(@!$_SESSION['user']){
	_alert_back_url('请先登录','login.php');
}
if(@$_POST['action']=='add_super'){
	_fetch_array($_conn,"SELECT name,state FROM ag_admin WHERE name='{$_POST['name']}' AND state=1 LIMIT 1",MYSQL_ASSOC,'对不起！用户名已存在');
	//引入注册界面的js验证
	include ROOT_PATH.'includes/register.func.php';
	$_admin=array();
	$_admin['name']=_check_username($_POST['name'],2,20);
	$_admin['pwd']=_check_password($_POST['pws'],$_POST['pws2'],5);
	$_admin['face']=$_POST['face'];
	mysqli_query($_conn,"INSERT INTO ag_admin(name,password,face,state) VALUES ('{$_admin['name']}','{$_admin['pwd']}','{$_admin['face']}','1')");
	if(mysqli_affected_rows($_conn)==1){
		_alert_url_null("恭喜你，成功添加超级管理员！","super_admin.php");
		}else{
		_alert_back_url("添加超级管理员失败！","add_super.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" charset="utf-8">
	<title>商丘工学院图书馆后台座位管理系统</title>
	<link rel="shortcut icon" href="favicon.jpg">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/admin.css">
</head>
<body>
<!-- header -->
<?php require dirname(__FILE__).'/includes/admin_header.inc.php';?>
<!-- end header -->

<!-- content -->
<div class="container-fluid" id="container-main">
	<div class="page-container">
		<!-- left content -->
		<?php require dirname(__FILE__).'/includes/left_nav.inc.php';?>
		<!-- end left content -->

		<!-- right content -->
		<div class="page-content">
			<ol class="breadcrumb">
				<li><a href="index.php">控制面板</a></li>
				<li><a href="super_admin.php">超级管理员</a></li>
				<li>添加超级管理员</li>
			</ol>
			<p>添加超级管理员</p>
			<!-- content header -->
			<form method="post" action="add_super.php">
			<input type="hidden" name="action" value="add_super">
			<table class="add_super">
				<tr>
					<td>管理员名:</td>
					<td><input type="text" name="name"></td>
				</tr>
				<tr>					
					<td>管理员密码:</td>
					<td><input type="password" name="pws"></td>
				</tr>
				<tr>					
					<td>确认密码:</td>
					<td><input type="password" name="pws2"></td>
				</tr>
				<tr>					
					<td><input type="hidden" id="face" name="face" value="img01.jpg">管理员头像:</td>
					<td><img src="face/img01.jpg" alt="face/img01.jpg" id="faceimg"></td>
				</tr>
			</table>
			<input class="btn btn-default btn-primary btn_super" type="submit" value="提交">&nbsp;
			<input class="btn btn-default btn_super2" type="reset" value="重置">
		</form>
		</div>
		<!-- end right content -->
	</div>
</div>
<!-- content end -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/face.js"></script>
<script type="text/javascript" src="js/floor.js"></script>>
</body>
</html>