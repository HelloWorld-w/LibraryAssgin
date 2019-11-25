<?php
//非法调用
define('IN_TG',true);
//开启session
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
if(@$_POST['action'] == 'register'){
	_check_code($_POST['yzm'],$_SESSION['code']);
	include ROOT_PATH.'includes/register.func.php';
	$_register=array();
	$_register['usename']=_check_username($_POST['user'],2,20);
	$_register['psw']=_check_password($_POST['psw'],$_POST['psw2'],5);
	$_register['face']=$_POST['face'];
	//查找重复的用户名
	_fetch_array($_conn,"SELECT name FROM ag_admin WHERE name='{$_register['usename']}' LIMIT 1",MYSQL_ASSOC,'对不起！用户名已存在');
	_query($_conn,"INSERT INTO 
							ag_admin(
								name,
								password,
								face
								)VALUES(
								'{$_register['usename']}',
								'{$_register['psw']}',
								'{$_register['face']}'
							)") or die('shujuku');						
		if(_affected_rows($_conn)==1){
			_close($_conn);
			//跳转
			_location('恭喜你，注册成功！！','login.php');
		}else{
			_close($_conn);
			//跳转
			_location('很遗憾，注册失败！','register.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" charset="utf-8">
	<title>商丘工学院图书馆座位管理系统</title>
	<link rel="icon" href="favicon.jpg">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/LoginRegister.css">
</head>
<body>
	<div class="modal show">
		<div class="modal-dialog">
			<div class="modal-content modal-content-modity">
				<div class="modal-header">
					<button type="button" class="close" id="close"><span>&times;</span></button>
					<div class="modal-title">会员注册</div>
				</div>
				<form method="post" name="register" action="register.php">
					<input type="hidden" name="action" value="register">
				<div class="modal-body register-form">
						<label for="">用 户 名：</label>
						<input type="text" name="user" class="input" placeholder="请输入您的用户名" value="" /><br/>
						<label for="">用 户 密 码：</label>
						<input type="password" name="psw" class="input" placeholder="请输入您的用户密码"/><br/>
						<label for="">确 认 密 码：</label>
						<input type="password" name="psw2" class="input" placeholder="请确认您的用户密码"/><br/>
						<input type="hidden" id="face" name="face" value="face/img01.jpg">
						<label for="">请选择头像：</label>&nbsp;<img src="face/img01.jpg" alt="face/img01.jpg" id="faceimg"><br/>
						<label for="">验 证：</label>
						<input type="text" name="yzm" class="inputt" placeholder="验证码"/><img src="code.php" alt="" id="code"><br/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default sub">注册</button>
					<button type="button" class="btn btn-default"><a href="login.php">登录</a></button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/face.js"></script>
</body>
</html>