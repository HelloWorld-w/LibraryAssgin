<?php
//非法调用
define('IN_TG',true);
//开启session
session_start();
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快
if(@$_POST['action'] == 'login'){
	//传递验证码
	_check_code($_POST['yzm'],$_SESSION['code']);
	//引入验证用户信息的js端验证（共数据库、js两种验证）
	include ROOT_PATH.'includes/register.func.php';
	//查询与用户输入相同的姓名、密码
	_query($_conn,"SELECT name,password FROM ag_username WHERE name='{$_POST['user']}' && password=sha1('{$_POST['psw']}')");
	if(_affected_rows($_conn)==1){
			//关闭数据库挂连接
			mysqli_close($_conn);
			//设置sessions
			$_SESSION['user']=$_POST['user'];
			//跳转
			_location('恭喜你，登录成功！！','index.php');
		}else{
			//关闭数据库挂连接
			mysqli_close($_conn);
			//跳转
			_location('密码或账户错误！','login.php');
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
					<div class="modal-title">会员登录</div>
				</div>
				<form method="post" name="login" action="login.php">
				<input type="hidden" name="action" value="login">
				<div class="modal-body register-form">
						<label for="">用 户 名：</label>
						<input type="text" name="user" class="input" placeholder="请输入您的用户名" value="" /><br/>
						<label for="">用 户 密 码：</label>
						<input type="password" name="psw" class="input" placeholder="请输入您的用户密码" value=""/><br/>
						<label for="">验 证：</label>
						<input type="text" name="yzm" class="inputt" placeholder="验证码" value=""/><img src="code.php" id="code"><br/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default">登录</button>
					<button type="button" class="btn btn-default sub"><a href="register.php">注册</a></button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
	<script type="text/javascript" src="js/code.js"></script>
</body>
</html>