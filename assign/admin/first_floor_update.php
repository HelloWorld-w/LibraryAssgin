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
@$sel_result=mysqli_fetch_array(mysqli_query($_conn,"SELECT st_stnumber,st_number,st_id FROM ag_adseat WHERE st_id=".substr($_GET['st_id'],0,-20)." LIMIT 1"),MYSQLI_ASSOC);
if(@$_POST['action']=='update'){
	mysqli_query($_conn,"UPDATE ag_adseat SET st_number='{$_POST['st_number']}',st_stnumber='{$_POST['st_stnumber']}' WHERE st_id='{$_POST['st_id']}'");
	if(mysqli_affected_rows($_conn)==1){
		//跳转	
		switch (substr($_POST['st_stnumber'],0,1)) {
		case 1:
			_location('恭喜你，成功修改座位信息！！','first_floor.php');
			break;
		case 2:
			_location('恭喜你，成功修改座位信息！！','second_floor.php');
			break;
		case 3:
			_location('恭喜你，成功修改座位信息！！','three_floor.php');
			break;
		}
		}else{
			//跳转
			_location('修改座位失败！！','first_floor_update.php');
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
				<li><a href="index.php">控制面板</a>&nbsp;/&nbsp;
					<?php if(substr($sel_result['st_stnumber'],0,1)!=null){
					switch (substr($sel_result['st_stnumber'],0,1)) {
						case 1:
					?>
					<a href="first_floor.php">一楼</a>&nbsp;/&nbsp;
					<?php
							break;
						case 2:
					?>
					<a href="second_floor.php">二楼</a>&nbsp;/&nbsp;
					<?php
							break;
						case 3:
					?>
					<a href="second_floor.php">三楼</a>&nbsp;/&nbsp;
					<?php
							break;
						}	
					}
					?>
				座位修改</li>
			</ol>
			<!-- end content header -->
			<div class="content-body">
				<span>五种状态 1:我的 3:预约 4:可选 5:等待维修</span>
				<form method="post" action="first_floor_update.php" name="insert">
				<input type="hidden" value="update" name="action">
				<table class="update">
				<thead>
					<tr>
						<th colspan="3">修改座位信息</th>
					</tr>
				</thead> 
				<tbody>
					<tr>
						<td><input type="hidden" value="<?php echo $sel_result['st_id'];?>" name="st_id">座位号:</td>
						<td><input type="number" min=1001 step="1" name="st_stnumber" value="<?php echo $sel_result['st_stnumber'];?>"></td>
					</tr>
					<tr>
						<td>座位号状态:</td>
						<td><input type="number" name="st_number" max=5 min=1 step="1" value="<?php echo $sel_result['st_number'];?>"></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"><input class="btn btn-default btn-info" type="submit" value="修改">
						</td>
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