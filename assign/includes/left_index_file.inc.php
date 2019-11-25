<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}
?>
<div class="container-fluid" id="container-main">
	<div class="page-container">
		<!-- left content -->
<div class="page-sidebar">
	<div class="panel-group" id="accordion">
		<div class="panel-group panel-default panel-collapse" id="search-hidden">
			<div class="panel-heading">
				<h4 class="panel-title">
					<form action="post" method="">
						<div class="input-group">
						  <input type="text" class="form-control" placeholder="座位号" aria-describedby="basic-addon2">
						  <span class="input-group-addon" id="basic-addon2"><i class="glyphicon glyphicon-search"></i></span>
						</div>
					</form>
				</h4>
			</div>
		</div>
		<div class="panel-group panel-default panel-collapse">
			<div class="panel-heading panel-head">
				<h4 class="panel-title">
					<a href="first_floor.php">一楼</a>
				</h4>
			</div>
		</div>
		<div class="panel-group panel-default panel-collapse">
			<div class="panel-heading panel-head">
				<h4 class="panel-title">
					<a href="second_floor.php">二楼</a>
				</h4>
			</div>
		</div>
		<div class="panel-group panel-default panel-collapse">
			<div class="panel-heading panel-head">
				<h4 class="panel-title">
					<a href="three_floor.php">三楼</a>
				</h4>
			</div>
		</div>
	</div>
</div>
		<!-- end left content -->

		<!-- right content -->
		<?php require ROOT_PATH.'includes/right_file.inc.php';?>
		<!-- end right content -->
	</div>
</div>