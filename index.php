<?php
require_once realpath('vendor/autoload.php');
use Todos\operation;
$opt = new operation;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>My To Do</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-sm-12 m-auto ">
					<h1 class="text-center mt-5" style="font-size: 8.5rem;color: #ff000042; letter-spacing: 1px;">todos</h1>
					<div class="card mt-4 card-customization">
						<div class="add-content card-body" style="padding: 0px;">
							<form action="" method="POST" class="todo-form" onsubmit="todoPost(event, $(this))">
								<input type="text" name="todolist" required class="todo-field">
								<button type="submit" name="todo-add"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
								</svg></button>
								<div class="left-icon">
									<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
									</svg>
								</div>
							</form>
						</div>
						<div class="card-content">
							<div id="active" class="custom-tab">
								<div class="activedata">
									<?php
									$opt->todoDisplay('todolist', 'active', 'DESC');  //Perametar 1 is table name and 2 is data condition, available condition is [all, active, completed].
									?>
								</div>
							</div>
							<div id="completed" class="custom-tab">
								<div class="completeddata">
									<?php
									$opt->todoDisplay('todolist', 'completed', 'DESC');  //Perametar 1 is table name and 2 is data condition, available condition is [all, active, completed].
									?>
								</div>
							</div>
							<div id="all" class="custom-tab active">
								<div class="alldata">
									<?php
									$opt->todoDisplay('todolist', 'all', 'DESC');  //Perametar 1 is table name and 2 is data condition, available condition is [all, active, completed].
									?>
								</div>
							</div>
						</div>
						<div class="card-footer">
							<div class="row ">
								<div class="col-md-3 counteradder text-sm-left mb-sm-1">
									<span class="realodcounter" style="font-size: 13px; color:#555;"><?=$opt->dataCount('todolist', 'WHERE status = 1');?> Item<?=($opt->dataCount('todolist', 'WHERE status = 1') > 1 ? '(s)' : '');?> Left</span>
								</div>
								<div class="col-md-6 text-sm-left mb-sm-1">
									<a href="javascript:void(0)" class="custom-btn active" data-tabid = 'all'>All</a> <a href="javascript:void(0)" class="custom-btn" data-tabid='active'>Active</a> <a href="javascript:void(0)" data-tabid='completed' class="custom-btn">Completed</a>
								</div>
								<div class="col-md-3  text-md-right text-sm-left">
									<a href="javacript:void(0)" class="clear-completed" style="display: none;" onclick="todoClear(event, $(this), 'all')">Clear Completed</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<p class="text-center text-success mt-4">Click readme file to run this project <a href="readme.html" target="_blank">readme.html</a></p>
	</body>
	<script src="js/jquery/jquery-3.4.1.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="//cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	
</html>