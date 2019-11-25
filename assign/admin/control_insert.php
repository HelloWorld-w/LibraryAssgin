<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
//开启session
session_start();
if(!$_SESSION['user']){
	_alert_back_url('请先登录','login.php');
}
if(@$_POST['action']=='insert'){
	$_time=$_POST['time'];
	$_title=$_POST['title'];
	$_content=$_POST['content'];
	_query($_conn,"INSERT INTO 
							ag_control_panel(
								time,
								title,
								content
								)VALUES(
								'$_time',
								'$_title',
								'$_content'
							)") or die('shujuku');						
		if(_affected_rows($_conn)==1){
			mysqli_close($_conn);
			//跳转
			_location('恭喜你，添加内容成功！！','control_panel.php');
		}else{
			mysqli_close($_conn);
			//跳转
			_location('很遗憾，添加内容失败！','control_insert.php');
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
	<link rel="stylesheet" type="text/css" href="css/contral_panel.css">
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
			<!-- content header -->
			<ol class="breadcrumb bread">
				<li><a href="index.php">控制面板</a>&nbsp;/&nbsp;<a href="control_panel.php">控制面板通知管理</a>&nbsp;/&nbsp;添加内容</li>
			</ol>
			<!-- end content header -->
			<div class="content-body">
				<form method="post" name="insert" action="control_insert.php">
					<input type="hidden" name="action" value="insert">
					<table class="control_update">
						<thead>
							<tr>
								<th colspan="2">修改内容</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input name="id" type="hidden" value="">时间:</td>
								<td><input name="time" type="text" value=""></td>
							</tr>
							<tr>
								<td>题目:</td>
								<td><input name="title" type="text" value=""></td>
							</tr>
							<tr>
								<td>内容:</td>
								<td>
									<textarea name="content"></textarea>
								</td>
							</tr>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"><input class="btn btn-default btn-info" type="submit" value="添加"></td>
							</tr>
						</tfoot>
					</table>
				</form>
			</div>
		</div>
		<!-- end right content -->
	</div>
</div>
<!-- content end -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/floor.js"></script>
</body>
</html>	