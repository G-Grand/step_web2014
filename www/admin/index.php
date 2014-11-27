<?php
	session_start();
	if(empty($_SESSION['userInfo'])) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Adminka =)</title>
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/moment-with-langs.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.ru.js"></script>
</head>
<body>
	<!-- navigation bar -->
	<div class="navbar navbar-inverse navbar-fixed-top">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	                <span class="icon-bar"></span>
	            </button>
	            <a href="#" class="navbar-brand">CMS_project</a>
	        </div>
	        <div class="navbar-collapse collapse">
	            <ul class="nav navbar-nav">
	            </ul>
	            <ul class='nav navbar-nav navbar-right'>
	            	<li><a>Привет, !</a></li>
        			<li>
        				<form class='navbar-form' action='../autorizetion.php' method='POST'>
            				<button name='exit' type='submit' class='btn btn-warning' value='ex'>Выйти</button>
        				</form>
        			</li>
        		</ul>
	        </div>
	    </div>
	</div>

	<div class="container" style="margin-top: 100px;">
		<div class="panel panel-default">
			<div class="panel-body">
				<h3>In admin panel =)</h3>
			</div>
		</div>
	</div>
</body>
</html>