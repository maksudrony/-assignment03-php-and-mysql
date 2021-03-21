<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image:url(car2.jpg); width:100%; background-size: cover;">

  <h1 id="welcomeDiv" align="center" style="padding: 10px 0px 10px 0px; background-color:coral; color: white;border: 1.5px solid white;">
  -- Welcome to Car Repair Shop --
  </h1>
  <div class="header" style="width: 30%;">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php" style="width: 30%;">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user" style="padding: 10px 15px 10px 15px;">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>					