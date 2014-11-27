<?php
	function __autoload($className) {
	    if(file_exists("../sourse/core/".$className.".class.php"))
	    {
	        include_once "..//sourse/core/".$className.".class.php";
	    }else {
	        die("MEGA FATAL!!!!!");
	    }
	} 	

	session_start();
	if(empty($_SESSION['userInfo'])) {
        header("Location: login.php");
    }

    $user = unserialize($_SESSION['userInfo']);
    $login = $user->getName();


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
    <style type="text/css">
		.tabs-below > .nav-tabs,
		.tabs-right > .nav-tabs,
		.tabs-left > .nav-tabs {
		  border-bottom: 0;
		}

		.tab-content > .tab-pane,
		.pill-content > .pill-pane {
		  display: none;
		}

		.tab-content > .active,
		.pill-content > .active {
		  display: block;
		}

		.tabs-below > .nav-tabs {
		  border-top: 1px solid #ddd;
		}

		.tabs-below > .nav-tabs > li {
		  margin-top: -1px;
		  margin-bottom: 0;
		}

		.tabs-below > .nav-tabs > li > a {
		  -webkit-border-radius: 0 0 4px 4px;
		     -moz-border-radius: 0 0 4px 4px;
		          border-radius: 0 0 4px 4px;
		}

		.tabs-below > .nav-tabs > li > a:hover,
		.tabs-below > .nav-tabs > li > a:focus {
		  border-top-color: #ddd;
		  border-bottom-color: transparent;
		}

		.tabs-below > .nav-tabs > .active > a,
		.tabs-below > .nav-tabs > .active > a:hover,
		.tabs-below > .nav-tabs > .active > a:focus {
		  border-color: transparent #ddd #ddd #ddd;
		}

		.tabs-left > .nav-tabs > li,
		.tabs-right > .nav-tabs > li {
		  float: none;
		}

		.tabs-left > .nav-tabs > li > a,
		.tabs-right > .nav-tabs > li > a {
		  min-width: 74px;
		  margin-right: 0;
		  margin-bottom: 3px;
		}

		.tabs-left > .nav-tabs {
		  float: left;
		  margin-right: 19px;
		  border-right: 1px solid #ddd;
		}

		.tabs-left > .nav-tabs > li > a {
		  margin-right: -1px;
		  -webkit-border-radius: 4px 0 0 4px;
		     -moz-border-radius: 4px 0 0 4px;
		          border-radius: 4px 0 0 4px;
		}

		.tabs-left > .nav-tabs > li > a:hover,
		.tabs-left > .nav-tabs > li > a:focus {
		  border-color: #eeeeee #dddddd #eeeeee #eeeeee;
		}

		.tabs-left > .nav-tabs .active > a,
		.tabs-left > .nav-tabs .active > a:hover,
		.tabs-left > .nav-tabs .active > a:focus {
		  border-color: #ddd transparent #ddd #ddd;
		  *border-right-color: #ffffff;
		}

		.tabs-right > .nav-tabs {
		  float: right;
		  margin-left: 19px;
		  border-left: 1px solid #ddd;
		}

		.tabs-right > .nav-tabs > li > a {
		  margin-left: -1px;
		  -webkit-border-radius: 0 4px 4px 0;
		     -moz-border-radius: 0 4px 4px 0;
		          border-radius: 0 4px 4px 0;
		}

		.tabs-right > .nav-tabs > li > a:hover,
		.tabs-right > .nav-tabs > li > a:focus {
		  border-color: #eeeeee #eeeeee #eeeeee #dddddd;
		}

		.tabs-right > .nav-tabs .active > a,
		.tabs-right > .nav-tabs .active > a:hover,
		.tabs-right > .nav-tabs .active > a:focus {
		  border-color: #ddd #ddd #ddd transparent;
		  *border-left-color: #ffffff;
		}

    </style>
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
	            	<li><a>Привет, <?=$login?>!</a></li>
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
			    <div class="tabbable tabs-left">
    				<ul class="nav nav-tabs">
      					<li><a href="#a" data-toggle="tab">One</a></li>
      					<li class="active"><a href="#b" data-toggle="tab">Two</a></li>
      					<li><a href="#c" data-toggle="tab">Twee</a></li>
    				</ul>
    				<div class="tab-content">
     					<div class="tab-pane active" id="a">Lorem ipsum dolor sit amet, charetra varius quam sit amet vulputate. 
     						Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero.
     					</div>
     					<div class="tab-pane" id="b">Secondo sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
     						Aliquam in felis sit amet augue.
     					</div>
     					<div class="tab-pane" id="c">Thirdamuno, ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
     						Quisque mauris augue, molestie tincidunt condimentum vitae. 
     					</div>
    				</div>
  				</div>
			</div>
		</div>
	</div>
</body>
</html>