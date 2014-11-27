<?php 
	session_start();
	if(!empty($_SESSION['userInfo'])) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>	
<html>
<head>
	<meta charset="utf-8" />
	<title>login</title>
		<link type="text/css" rel="stylesheet" href="../css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="../css/bootstrap-datetimepicker.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.js"></script>
    <script type="text/javascript" src="../js/moment-with-langs.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.ru.js"></script>
    <style type="text/css">

    </style>
</head>
<body>
	<div class="container" style="width: 300px;">
      <form class="form-signin" role="form" action="http://web-site.local/autorizetion.php" method="POST">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input name="login" type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input name="pass" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div> <!-- /container -->
</body>

</html>