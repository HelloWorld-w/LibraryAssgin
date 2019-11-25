<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit("非法调用");
}
?>
<nav class="navbar navbar-default" id="navbar-body">
	<div class="navbar-header">
		<a href="###" class="navbar-brand"><h1 class="h1">商丘工学院自习室后台管理系统</h1></a>
	</div>
	<div class="navbar-account navbar-right">
		<?php
			if(isset($_SESSION['user'])){
				$result=mysqli_query($_conn,"SELECT name,face FROM ag_admin WHERE name = '{$_SESSION['user']}' LIMIT 1");
				if($res=mysqli_fetch_array($result)){
					echo "<img src='".$res[1].".jpg' alt=''>";
					echo "<span class='account-name'>".$res[0]."</span>";
					echo "<span class='account-name'><a href='login_out.php'>退出</a></span>";
				}
			}else{
				echo '<span><a href="login.php">登录</a>/<a href="register.php">注册</a></span>';
			}
		?>
	</div>
</nav>