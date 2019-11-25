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
//删除数据
if(@$_GET['action']=='del'){
	$id=substr($_GET['id'],0,-20);
	$del_result=mysqli_query($_conn,"DELETE FROM ag_control_panel WHERE id=".$id);
	if($del_result){
		_alert_url_null("恭喜你，成功删除公告！","control_panel.php");
		}else{
		_alert_back_url("删除公告失败！","control_panel.php");
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
				<li><a href="index.php">控制面板</a>&nbsp;/&nbsp;控制面板通知管理</li>
			</ol>
			<!-- end content header -->
			<div class="content-body">
				<table class="control_panel">
					<thead>
						<tr>
							<th>时间</th>
							<th>类别</th>
							<th>内容</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$result=mysqli_query($_conn,"SELECT * FROM ag_control_panel");
							while($date=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
						?>
						<tr>
							<td><?php echo $date['time'];?></td>
							<td><?php echo $date['title'];?></td>
							<td><?php echo $date['content'];?></td>
							<td><a href="control_update.php?action=update&&id=<?php echo _url_sha1($date['id']);?>">修改</a>/<a href="control_panel.php?action=del&&id=<?php echo _url_sha1($date['id']);?>">删除</a></td>
						</tr>
						<?php
							}
						?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="4"><a href="control_insert.php"><button class="btn btn-default btn-info">&nbsp;添加通知&nbsp;</button></a></td>
						</tr>
					</tfoot>
				</table>
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