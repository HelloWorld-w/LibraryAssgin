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
//查询超级管理员
$_super=mysqli_query($_conn,"SELECT id,name,face FROM ag_admin WHERE state=1");
//查看当前用户state
$_super_user=mysqli_fetch_array(mysqli_query($_conn,"SELECT state FROM ag_admin WHERE name='{$_SESSION['user']}'"))['state'];
//删除超级管理员
if(@$_GET['action']=='del_super'){
	mysqli_query($_conn,"DELETE FROM ag_admin WHERE id=".substr($_GET['id'],0,-20));
	if(mysqli_affected_rows($_conn)==1){
			_alert_url_null("恭喜你，成功删除超级管理员！","super_admin.php");
		}else{
			_alert_back_url("删除超级管理员失败！","super_admin.php");
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
				<li>超级管理员</li>
			</ol>
			<?php if($_super_user==1){?>
				<p><a href="add_super.php">添加超级管理员</a></p>
			<?php }else{?>
				<p>超级管理员列表</p>
			<?php } ?>
			<!-- content header -->
			<table class="super_admin">
				<tr>
					<th>管理员ID</th>
					<th>管理员名</th>
					<th>管理员头像</th>
					<?php if($_super_user==1){?>
					<th>操作</th>
					<?php }?>
				</tr>
				<?php while($super_result=mysqli_fetch_array($_super,MYSQLI_ASSOC)){?>
				<tr>					
					<td><?php echo $super_result['id'];?></td>
					<td><?php echo $super_result['name'];?></td>
					<td><?php echo $super_result['face'];?></td>
					<?php if($_super_user==1){?>
					<td><a href="super_admin.php?action=del_super&&id=<?php echo _url_sha1($super_result['id']);?>">删除</a>/<a href="update_super.php?action=<?php echo _url_sha1($super_result['id']);?>">修改</a></td>
					<?php }?>
				</tr>
				<?php }?>
			</table>
		</div>
		<!-- end right content -->
	</div>
</div>
<!-- content end -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/floor.js"></script>
</body>
</html>