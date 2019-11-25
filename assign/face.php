<?php
//非法调用
define('IN_TG',true);
//引入公共文件
require dirname(__FILE__).'/includes/common.inc.php';//转化为硬路径速度更快s
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1,user-scalable=no" charset="utf-8">
	<title>商丘工学院图书馆座位管理系统</title>
	<link rel="icon" href="favicon.jpg">
	<link rel="stylesheet" type="text/css" href="css/face.css">
	<script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
	<div class="face">
		<h3>头像选择</h3>
		<dl>
			<?php foreach(range(1,21) as $num){?>
			<dd><img src="face/img<?php echo 'img'+$num<10?("0".$num):$num;?>.jpg" alt="face/img<?php echo 'img'+$num<10?("0".$num):$num;?>.jpg" title="img<?php echo 'img'+$num<10?("0".$num):$num;?>.jpg"></dd>
			<?php }?>

		</dl>
	</div>
	
</body>
</html>