<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit("非法调用");
}
?>
<div class="page-sidebar">
				<div class="panel-group" id="accordion">
					<div class="panel-group panel-default panel-collapse">
						<div class="panel-heading panel-head">
							<h4 class="panel-title">
								<a href="#collapseOne" data-toggle="collapse" data-parent="#accordion">管理员</a>
							</h4>
						</div>
						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="list-group list-modify">
									<a href="super_admin.php" class="list-group-item">超级管理员</a><hr>
									<a href="middle_admin.php" class="list-group-item">普通管理员</a><hr>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group panel-default panel-collapse">
						<div class="panel-heading panel-head">
							<h4 class="panel-title">
								<a href="#collapseTwo" data-toggle="collapse" data-parent="#accordion">座位管理</a>
							</h4>
						</div>
						<div id="collapseTwo" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="list-group list-modify">
									<a href="first_floor.php" class="list-group-item">一楼</a><hr>
									<a href="second_floor.php" class="list-group-item">二楼</a><hr>
									<a href="three_floor.php" class="list-group-item">三楼</a><hr>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-group panel-default panel-collapse">
						<div class="panel-heading panel-head">
							<h4 class="panel-title">
								<a href="control_panel.php">控制面板通知管理</a>
							</h4>
						</div>
					</div>
				</div>
			</div>