<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}
$result=mysqli_query($_conn,"SELECT time, title, content FROM ag_control_panel order by id desc limit 3");
?>
<div class="page-content">
	<!-- content header -->
	<ol class="breadcrumb">
		<li>控制面板</li>
	</ol>
	<!-- end content header -->
	<?php
	if(mysqli_affected_rows($_conn)){
		?>
	<div class="content-body"><br><br><br>
		<?php 
		while($select_result=mysqli_fetch_array($result,MYSQLI_ASSOC)){
		?>
		<div class="content-content">
			<p><?php echo $select_result['title'];?></p>
			<p><?php echo $select_result['time'];?></p>
			<p><?php echo $select_result['content'];?></p>
		</div>
		<?php }?>
		
	</div>
	<?php
		}else{
	?>
	<div class="content-body"><br><br><br><br><br><br>
		<p>欢迎来到商丘工学院自习室座位管理系统</p>
		<span><a href="http://www.sqgxy.com" style="color: #000;">官网地址：http://www.sqgxy.com</a></span>&nbsp;&nbsp;&nbsp;
		<span>联系我们：0370-3020999</span>
	</div>
	<?php
		}
	?>
</div>