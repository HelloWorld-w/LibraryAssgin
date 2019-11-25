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
//管理员删除座位
if(@$_GET['action']=='del'){
	mysqli_query($_conn,"DELETE FROM ag_adseat WHERE st_stnumber=".substr($_GET['st_stnumber'],0,-20));
	if(mysqli_affected_rows($_conn)==1){
			_alert_url_null("恭喜你，删除座位成功！","first_floor.php");
		}else{
			_alert_back_url("删除座位失败！","first_floor.php");
		}	
}
//管理员删除指定的某一些座位
// if(@$_POST['checked']=='check_val'){
// 	echo $_POST['checked'];
// }
// echo ($_POST['checksel']);
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
				<li><a href="index.php">控制面板</a>&nbsp;/&nbsp;一楼</li>
			</ol>
			<p><a href="first_floor_insert.php"><button class="btn btn-default btn-info" value="添加座位">添加座位</button></a></p>
			<!-- end content header -->
			<div class="content-body">
				<span>五种状态 1:我的 4:可选 5:等待维修</span>
				<table class="content-table">
					<tr>
					<?php
					//分页
					//查询ag_adseat数据库
					$_result=mysqli_query($_conn,"SELECT * FROM ag_adseat WHERE st_stnumber>1000 AND st_stnumber<2000 order by st_stnumber");
					//数据库中一共有多少位子
					$page_sum_seat=mysqli_num_rows($_result);
					// echo ($page_sum_seat);
					//每页显示多少个位子
					$page_size=66;
					//最大页面
					if($page_sum_seat%$page_size==0){
							$maxpage=(int)($page_sum_seat/$page_size);
						}else{
							$maxpage=(int)($page_sum_seat/$page_size)+1;
					}
					//当前显示的页码
					if(isset($_GET['curpage'])){
					        $page=$_GET['curpage'];
					    }else{
					        $page=1;
					    }
					 $start=$page_size*($page-1);
					 // echo $start;
					 // exit();
					$limit_data_page=mysqli_query($_conn,"SELECT st_stnumber,st_number FROM ag_adseat WHERE st_stnumber>1000 AND st_stnumber<2000 order by st_stnumber limit " .$start.",66");
					//表格中的每列显示的条数
					$cols_seat=11;
					//$limit_data_page传过来多少位子
					$cols_sum_seat=mysqli_num_rows($limit_data_page);
					//表格中显示的列数
					if($cols_sum_seat%$cols_seat==0){
							$cols=(int)($cols_sum_seat/$cols_seat);
						}else{
							$cols=(int)($cols_sum_seat/$cols_seat)+1;
						}
					//把表格中每列的值显示出来
					for($i=1;$i<=$cols;$i++){
						$limit_seat=mysqli_query($_conn,"SELECT st_stnumber,st_number,st_id FROM ag_adseat WHERE st_stnumber>1000 AND st_stnumber<2000 order by st_stnumber limit ".(11*($i-1)+$start).",11");
					?>
						<td>
							<table class="content-table2">
								<tr>
									<td></td>
									<td>座位号</td>
									<td>座位号状态</td>
									<td>操作</td>
								</tr>
								<?php
									while ($result=mysqli_fetch_array($limit_seat,MYSQLI_ASSOC)) {
								?>
								<tr>
									<td><input type="checkbox" name="checkbox" value="<?php echo $result['st_stnumber'];?>"/></td>
									<td><?php echo $result['st_stnumber'];?></td>
									<td><?php echo $result['st_number'];?></td>
									<td><a href="first_floor_update.php?st_id=<?php echo _url_sha1($result['st_id']);?>">修改</a>/<a href="first_floor.php?action=del&&st_stnumber=<?php echo _url_sha1($result['st_stnumber']);?>">删除</a></td>
								</tr>
								<?php }?>
							</table>
						</td>
					<?php
						}
					?>
					</tr>
					<tr class="content-last">
						<td colspan="6">
							<button class="btn btn-default btn-ms" onclick="setAll()">全选</button>
							<button class="btn btn-default btn-ms" onclick="setNo()">全不选</button>
							<a href="" onclick="show()">删除</a>
						</td>
					</tr>
				</table>
			</div>
			<div id="page"> 
            <?php echo "共".$maxpage."页&nbsp;&nbsp;&nbsp;";
                      echo "每页".$page_size."项&nbsp;&nbsp;&nbsp;";
            if($page>1){
                $prepage=$page-1;
                echo "<a href='?curpage=$prepage'>上一页</a>&nbsp;&nbsp;";
            }
            if($page<$maxpage){
                 $nextpage=$page+1;
                 echo "<a href='?curpage=$nextpage'>下一页</a>&nbsp;&nbsp;";
            }
            echo "&nbsp;&nbsp;当前第 $page 页</p>";
            ?>
    </div>
		</div>
		<!-- end right content -->
	</div>
</div>
<!-- content end -->
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/checked.js"></script>
<script type="text/javascript" src="js/floor.js"></script>
</body>
</html>