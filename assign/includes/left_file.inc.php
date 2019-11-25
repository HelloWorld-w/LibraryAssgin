<?php
// 防止恶意调用
if(!defined('IN_TG')){
	exit('非法调用');
}
?>
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
					<a href="first_floor.php" data-target="#collapseOne" data-toggle="collapse" data-parent="#accordion">一楼</a>
				</h4>
			</div>
			<!-- <div id="collapseOne" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="list-group list-modify">
						<a href="" class="list-group-item">空闲</a><hr>
						<a href="" class="list-group-item">预定</a><hr>
						<a href="" class="list-group-item">占位</a><hr>
					</div>
				</div>
			</div> -->
		</div>
		<div class="panel-group panel-default panel-collapse">
			<div class="panel-heading panel-head">
				<h4 class="panel-title">
					<a href="second_floor.php" data-target="#collapseTwo" data-toggle="collapse" data-parent="#accordion">二楼</a>
				</h4>
			</div>
			<!-- <div id="collapseTwo" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="list-group list-modify">
						<a href="" class="list-group-item">空闲</a><hr>
						<a href="" class="list-group-item">预定</a><hr>
						<a href="" class="list-group-item">占位</a><hr>
					</div>
				</div>
			</div> -->
		</div>
		<div class="panel-group panel-default panel-collapse">
			<div class="panel-heading panel-head">
				<h4 class="panel-title">
					<a href="three_floor.php" data-target="#collapseThree" data-toggle="collapse" data-parent="#accordion">三楼</a>
				</h4>
			</div>
			<!-- <div id="collapseThree" class="panel-collapse collapse in">
				<div class="panel-body">
					<div class="list-group list-modify">
						<a href="" class="list-group-item">空闲</a><hr>
						<a href="" class="list-group-item">预定</a><hr>
						<a href="" class="list-group-item">占位</a><hr>
					</div>
				</div>
			</div> -->
		</div>
	</div>
</div>