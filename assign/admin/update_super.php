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
//查找该id号的信息
@$update_user=mysqli_fetch_array(mysqli_query($_conn,"SELECT id,name,face,state FROM ag_admin WHERE id=".substr($_GET['action'],0,1)));
//查找当前用户是否为超级管理员
@$update_session=mysqli_fetch_array(mysqli_query($_conn,"SELECT state FROM ag_admin WHERE name='{$_SESSION['user']}'"))['state'];
//修改该id号的信息
if(@$_POST['action']=='update_super'){
	mysqli_query($_conn,"UPDATE ag_admin SET name='{$_POST['name']}',face='{$_POST['face']}',state='{$_POST['radio']}' WHERE id='{$_POST['id']}'");
	if(mysqli_affected_rows($_conn)){
		if($_POST['radio']==0){
			_alert_url_null("恭喜你，成功修改普通管理员！","super_admin.php");
		}else{
			_alert_url_null("恭喜你，成功修改超级管理员！","middle_admin.php");
		}
	}else{
		_alert_back_url("修改超级管理员失败！","add_admin.php");
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
				<li>修改超级管理员</li>
			</ol>
			<p>修改超级管理员</p>
			<!-- content header -->
			<form method="post" action="update_super.php">
			<input type="hidden" name="action" value="update_super">
			<table class="update_admin">
				<tr>
					<td><input type="hidden" value="<?php echo $update_user['id'];?>" name="id">管理员名:</td>
					<td><input type="text" name="name" value="<?php echo $update_user['name'];?>"></td>
				</tr>
				<?php if($update_session==1){?>
				<tr>
					<td>设置为超级管理员:</td>
					<td><label for="radio1">是:<input type="radio" value="1" id="radio1" name="radio"></label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="radio2">否:<input type="radio" value="0" id="radio2" name="radio" checked></label></td>
				</tr>
				<?php }?>
				<tr>					
					<td><input type="hidden" id="face" name="face" value="<?php echo $update_user['face'];?>">管理员头像:</td>
					<td>&nbsp;&nbsp;<img src="face/img01.jpg" alt="face/img01.jpg" id="faceimg"></td>
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
<script type="text/javascript" src="js/floor.js"></script>
</body>
</html>