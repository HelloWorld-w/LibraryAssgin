<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}
//用户占位置
if(@$_POST['action']=='seat_select'){
	// 判断该用户是否已经占位了
	if(@mysqli_fetch_array(mysqli_query($_conn,"SELECT st_stnumber FROM ag_seat WHERE st_user='{$_SESSION['user']}' and st_used=0"))){
		_alert_back_url('不得重复占位','three_floor.php?');
	}else{
		_alert_url_null('占位成功！','three_floor.php?');
	}
	//将占位的信息插入数据库表中
	mysqli_query($_conn,"INSERT INTO ag_seat(st_number,st_user,st_time,st_stnumber,st_sumtime,st_text) VALUES ('{$_POST['number']}','{$_SESSION['user']}','{$_POST['time']}'*3600,'{$_POST['seatnum']}','{$_POST['time']}'*3600,'{$_POST['lanage']}')");
	//改变ag_adseat数据库中的内容
	mysqli_query($_conn,"UPDATE ag_adseat SET st_number='{$_POST['number']}' WHERE st_stnumber='{$_POST['seatnum']}'");	
	}
//用户增加时长
if(@$_POST['action']=='addtime'){
	//判断用户是否占位
	if($_addtime=mysqli_fetch_array(mysqli_query($_conn,"SELECT st_stnumber,st_time,st_sumtime FROM ag_seat WHERE st_used=0 AND st_user='{$_SESSION['user']}'"),MYSQLI_ASSOC)){
		//修改用户占位时长剩余时长
		mysqli_query($_conn,"UPDATE ag_seat SET st_time='{$_addtime['st_time']}'+'{$_POST['add_time']}'*3600 WHERE st_stnumber='{$_POST['seatnum']}' AND st_used=0");
		//从数据库中查询修改后的剩余时间
		$_surplus=mysqli_fetch_array(mysqli_query($_conn,"SELECT st_time FROM ag_seat WHERE st_stnumber='{$_POST['seatnum']}' AND st_used=0"),MYSQLI_ASSOC)['st_time'];
		//把修改后的剩余时间放到session中
		$_SESSION['surplus_time']=$_surplus;
		//修改用户使用座位的总时间
		mysqli_query($_conn,"UPDATE ag_seat SET st_sumtime='{$_addtime['st_sumtime']}'+'{$_POST['add_time']}'*3600 WHERE st_stnumber='{$_POST['seatnum']}' AND st_used=0");
		if(mysqli_affected_rows($_conn)){
			_alert_url_null('延长占位时间成功！','three_floor.php?');
		}else{
			_alert_back_url('延长占位时间失败！','three_floor.php?');
		}
	}
}
//"我要等待"的这个位置的剩余时间
$_SESSION['wait_time']=mysqli_fetch_array(mysqli_query($_conn,"SELECT st_time FROM ag_seat WHERE st_number=1 AND st_used=0"))['st_time'];
//用户等待时间
if(@$_POST['action']=='wait'){
	mysqli_query($_conn,"INSERT INTO ag_seat(st_number, st_user, st_time, st_stnumber,st_used, st_sumtime, st_text,st_wait) VALUES ('{$_POST['number']}','{$_SESSION['user']}','{$_POST['timenum']}'*3600,'{$_POST['stnumber']}',0,'{$_POST['timenum']}'*3600,'{$_POST['lanage']}',1)");
	if(mysqli_affected_rows($_conn)==1){
		_alert_url_null('等待成功','three_floor.php');
	}else{
		_alert_back_url('等待失败','three_floor.php');
	}
}

//判断座位
if(@$_SESSION['surplus_time']==null || @$_SESSION['surplus_time']==0){
//获取用户使用座位所剩余的时间
$_SESSION['surplus_time']=(mysqli_fetch_array(mysqli_query($_conn,"SELECT st_time FROM ag_seat WHERE st_user='{$_SESSION['user']}' AND st_used=0"),MYSQLI_ASSOC)['st_time']);
}
echo $_SESSION['surplus_time'];
?>
<div id="right_display">
	<div class="display">
	<button class="btn btn-info navbar-left">西面West</button>
	<button class="btn btn-default btn-xs glyphicon glyphicon-ok" style="background:green;color:#fff;"></button>我的
	<button class="btn btn-default btn-xs glyphicon glyphicon-user"></button>已占
	<button class="btn btn-default btn-xs glyphicon glyphicon-time"></button>预约
	<button class="btn btn-default btn-xs glyphicon">&nbsp;</button>可选
	<button class="btn btn-default btn-xs glyphicon glyphicon-remove" style="background:red;color:#fff;"></button>等待维修
</div>
<table>
	<tr>
		<td>窗户</td>
	</tr>
	<?php
	//将数据库中的座位渲染出来
	$_seat=mysqli_query($_conn,"SELECT st_stnumber, st_number FROM ag_adseat WHERE st_stnumber>2000 AND st_stnumber<3000"); 
	// 数据库中有多少位子
	$seat_sum=mysqli_num_rows($_seat);
	$row_number=11;
	if($seat_sum%$row_number==0){
		$rows=(int)($seat_sum/$row_number);
	}else{
		$rows=(int)($seat_sum/$row_number)+1;
	}
	for($i=1;$i<=$rows;$i++){
	$sel_seat=mysqli_query($_conn,"SELECT a1.st_stnumber, a1.st_number,a2.st_user,a2.st_sumtime,a2.st_text,a2.st_wait FROM ag_adseat a1 left join ag_seat a2 on a1.st_stnumber = a2.st_stnumber AND a2.st_used=0 AND a2.st_wait=0 where a1.st_stnumber>2000 AND a1.st_stnumber<3000 limit ".(11*($i-1)).",11");
	$j=1;
	?>
	<tr>
		<td>
		<?php
		//将数据库中的座位一个一个的渲染出来
		while ($_selseat=mysqli_fetch_array($sel_seat,MYSQLI_ASSOC)) {
			//判断座位号的状态并显示
			if($_selseat['st_number']==1 && $_selseat['st_user']==$_SESSION['user'] && $_selseat['st_wait']==0) {
		?>
			<button class="btn btn-default btn-xs glyphicon glyphicon-ok" data-whatever="<?php echo $_selseat['st_stnumber'];?>" data-whatever1="<?php echo _time($_selseat['st_sumtime']);?>" data-toggle="modal" data-whatever2="<?php echo $_selseat['st_text'];?>" data-target="#myModal3" style="background:green;color:#fff;" title="<?php echo $_selseat['st_stnumber'];?>" onclick="timeDown(<?php echo $_SESSION['surplus_time'];?>);">
			</button>
		<?php
			}
			if($_selseat['st_number']==1 && $_selseat['st_user']!=$_SESSION['user']){
		?>
			<button class="btn btn-default btn-xs glyphicon glyphicon-user" data-whatever="<?php echo $_selseat['st_stnumber'];?>" data-whatever3="<?php echo _time($_SESSION['wait_time']);?>" data-toggle="modal" data-target="#myModal"  title="<?php echo $_selseat['st_stnumber'];?>"></button>
		<?php
	    }
		switch ($_selseat['st_number']) {
			case '3':
		?>
			<button class="btn btn-default btn-xs glyphicon glyphicon-time" data-whatever="<?php echo $_selseat['st_stnumber'];?>" data-toggle="modal" data-target="#myModal2" title="<?php echo $_selseat['st_stnumber'];?>"></button>
		<?php
		break;
			case '4':
		?>
			<button class="btn btn-default btn-xs glyphicon" data-toggle="modal" data-target="#myModal1" value="" data-whatever="<?php echo $glo=$_selseat['st_stnumber'];?>" title="<?php 
			echo $_selseat['st_stnumber'];
			?>">&nbsp;</button>
		<?php
		break;
			case '5':
		?>
			<button class="btn btn-default btn-xs glyphicon glyphicon-remove" data-toggle="modal"style="background:red;color:#fff;" title="<?php
			echo $_selseat['st_stnumber'];
			?>"></button>
		<?php
			}
		}
		?>
		</td>
	</tr>
	<?php
	}
	?>
	<!-- "我要等待"所使用的弹出框 -->
	<div class="modal fade" tabindex="-1" id="myModal">
		<div class="modal-dialog sm-lg">
			<form method="post" name="wait" action="second_floor.php">
			<input type="hidden" name="action" value="wait">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
					<div class="modal-title">位子使用情况</div>
				</div>
				<div class="modal-body modal_span">
					<span>座 位 号：</span><input class="seatnum" type="text" value="101号桌23号位" name="stnumber" readonly style="border:none; font-weight:bold;"/><br>
					<span>等 待 剩 余 时 间：</span><input class="wait_time" type="text" name="wait_time" readonly value="" style="border:none;"><br>
					<span>使 用 时 间：</span><input type="number" step="0.1" value="0.5" min="0.1" name="timenum" style="width:90px;">单位:小时<br/>
					<span>简 单 名 言 警 句：</span><input type="text" value="加油" name="lanage">
					<input type="hidden" value="1" name="number">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">我要等待</button>
				</div>
			</div>
			</form>
		</div>
	</div>
	<!-- "我要占位"所使用的弹出框 -->
	<div class="modal fade" tabindex="-1" id="myModal1">
		<div class="modal-dialog sm-lg">
			<div class="modal-content">
				<form method="post" name="seat_select" action="three_floor.php">
					<input type="hidden" name="action" value="seat_select">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
					<div class="modal-title">位子使用情况</div>
				</div>
				<div class="modal-body modal_span">
					<span>座 位 号：</span><input class="seatnum" type="text" value="101号桌23号位" name="seatnum" readonly style="border:none"/><br>
					<span>使 用 时 间：</span><input type="number" value="3" step="0.1" name="time" style="width:90px;">单位:小时<br/>
					<span>简 单 名 言 警 句：</span><input type="text" value="加油" name="lanage">
					<!-- 4号状态，要占位 -->
					<input type="hidden" value="1" name="number">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">我要占位</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<!-- "增加时长"弹出框 -->
	<div class="modal fade" tabindex="-1" id="myModal3">
		<div class="modal-dialog sm-lg">
			<form method="post" name="add_time" action="three_floor.php">
			<input type="hidden" name="action" value="addtime">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
					<div class="modal-title">位子使用情况</div>
				</div>
				<div class="modal-body modal_span">
					<span>座 位 号：</span><input class="seatnum" type="text" value="101号桌23号位" name="seatnum" readonly style="border:none; font-weight:bold;" /><br>
					<span>占 位 总 时 长：</span><input class="surplus_time" type="text" value="1"  readonly style="border:none;"/><br>
					<!-- 剩余时间 -->
					<span>占 位 剩 余 时 长：</span><b style="font-weight:normal;" id="surplus"></b><br/>
					<span>增 加 时 长：</span><input type="number" step="0.1" value="0.5" min="0.1" name="add_time" style="width:90px;">单位:小时<br/>
					<span>名 言 警 句：</span><input class="language_text" type="text" value="加油" name="language" readonly style="border:none;"/><br>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">增加时长</button>
				</div>
			</div>
			</form>
		</div>
	</div>
