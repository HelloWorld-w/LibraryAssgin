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
//向数据库中单独添加座位
if(@$_POST['action']=='insert'){
	mysqli_query($_conn,"SELECT st_stnumber FROM ag_adseat WHERE st_stnumber='{$_POST['st_stnumber']}' LIMIT 1");
	if(mysqli_affected_rows($_conn)==1){
		_alert_back_url("不能重复添加同一个座位号的座位！","first_floor_insert.php");
	}
	mysqli_query($_conn,"INSERT INTO ag_adseat(st_stnumber,st_number) VALUES ('{$_POST['st_stnumber']}','{$_POST['st_number']}')");
	if(mysqli_affected_rows($_conn)==1){
		switch (substr($_POST['st_stnumber'],0,1)) {
			case 1:
				_location('恭喜你，成功添加座位！！','first_floor.php');
				break;
			case 2:
				_location('恭喜你，成功添加座位！！','second_floor.php');
				break;
			case 3:
				_location('恭喜你，成功添加座位！！','three_floor.php');
				break;
		}
	}else{
		_location('添加座位失败！','first_floor_insert.php');
	}
}
//向数据库中批量添加座位
if(@$_POST['action']=='insert-all'){
	for($i=$_POST['start_stnumber'];$i<=$_POST['end_stnumber'];$i++){
		mysqli_query($_conn,"SELECT st_stnumber FROM ag_adseat WHERE st_stnumber='".$i."' LIMIT 1");
		if(mysqli_affected_rows($_conn)==1){
			_alert_back_url("不能重复添加同一个座位号的座位！","first_floor_insert.php");
		}
		mysqli_query($_conn,"INSERT INTO ag_adseat(st_stnumber,st_number) VALUES ('".$i."','{$_POST['st_number']}')");
	}
	if(mysqli_affected_rows($_conn)==1){
			_location('恭喜你，成功添加座位！！','first_floor.php');
		}else{
			_location('添加座位失败！','first_floor_insert.php');
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
	<link rel="stylesheet" type="text/css" href="css/floor.css">
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
				<li><a href="index.php">控制面板</a>&nbsp;/&nbsp;<a href="first_floor.php">一楼</a>&nbsp;/&nbsp;座位添加</li>
			</ol>
			<!-- end content header -->
			<div class="content-body">
				<span>五种状态 1:我的 3:预约 4:可选 5:等待维修</span>
				<div>
					<div class="insert">
						<form method="post" action="first_floor_insert.php" name="insert">
						<input type="hidden" value="insert" name="action">
						<table> 
							<tr>
								<th colspan="3">单条数据添加</th>
							</tr>
							<tr>
								<td>座位号:</td>
								<td><input type="number" min=1001 step="1" max="6000" name="st_stnumber" value="1001"></td>
							</tr>
							<tr>
								<td>座位号状态:</td>
								<td><input type="number" name="st_number" max=5 min=1 step="1" value="4"></td>
							</tr>
							<tr>
								<td colspan="3"><input class="btn btn-default btn-info" type="submit" value="添加"></td>
							</tr>
						</table>
						</form>
					</div>
					<div class="insert">
						<form method="post" action="first_floor_insert.php" name="insert-all">
						<input type="hidden" value="insert-all" name="action">
						<table> 
							<tr>
								<th colspan="3">批量数据添加</th>
							</tr>
							<tr>
								<td>开始座位号:</td>
								<td><input type="number" min=1001 step="1" max="6000" name="start_stnumber" value="1000"></td>
							</tr>
							<tr>
								<td>结束座位号:</td>
								<td><input type="number" min=1001 step="1" name="end_stnumber" value="1999"></td>
							</tr>
							<tr>
								<td>座位号状态:</td>
								<td><input type="number" name="st_number" max=5 min=1 step="1" value="4"></td>
							</tr>
							<tr>
								<td colspan="3"><input class="btn btn-default btn-info" type="submit" value="批量添加"></td>
							</tr>
						</table>
						</form>
					</div>
				</div>
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