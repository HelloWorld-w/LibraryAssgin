<?php
//开启session
session_start();
//把用户剩余的时间存在$_SESSION['surplus_time']
$_SESSION['surplus_time']=$_POST['times'];
//接受
if($_POST['timesecond']!=null && $_POST['timesecond']>=0){
	//连接数据库
	$_conn=mysqli_connect('localhost','root','root','assign');
	//每过一分钟把数据放到数据库中
	mysqli_query($_conn,"UPDATE ag_seat SET st_time='{$_POST['timesecond']}' WHERE st_user='{$_SESSION['user']}' AND st_used=0");

	if($_POST['timesecond']==0){
		//查找座位号和等待状态
		$_st=mysqli_fetch_array(mysqli_query($_conn,"SELECT st_stnumber,st_wait FROM ag_seat WHERE st_user='{$_SESSION['user']}' AND st_used=0"),MYSQLI_ASSOC);
		// if($_st['st_wait']==0){
			//更改ag_adseat数据表中的座位状态
			mysqli_query($_conn,"UPDATE ag_adseat SET st_number=4 WHERE st_stnumber='{$_st['st_stnumber']}'");
			//更改ag_seat数据表中的座位状态
			mysqli_query($_conn,"UPDATE ag_seat SET st_number=4 WHERE st_used=0 AND st_user='{$_SESSION['user']}' AND st_stnumber='{$_st['st_stnumber']}'");
			//更改座位使用状态
			mysqli_query($_conn,"UPDATE ag_seat SET st_used=1 WHERE st_used=0 AND st_stnumber='{$_st['st_stnumber']}'");
		// }
		mysqli_query($_conn,"SELECT st_wait FROM ag_seat WHERE st_stnumber='{$_st['st_stnumber']}' AND st_wait=1");
		if(mysqli_affected_rows($_conn)==1){
			//座位等待状态修改为0
			mysqli_query($_conn,"UPDATE ag_seat SET st_wait=0,st_used=0 WHERE st_stnumber='{$_st['st_stnumber']}' AND st_wait=1");
			//更改ag_adseat数据表中的座位状态
			mysqli_query($_conn,"UPDATE ag_adseat SET st_number=1 WHERE st_stnumber='{$_st['st_stnumber']}'");
		}
		//清除session中的剩余时间的值
		$_SESSION['surplus_time']=0;
		}
	}
?>