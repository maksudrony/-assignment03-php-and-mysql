<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image:url(car2.jpg); width:100%; background-size: cover;">
	<h1 id="welcomeDiv" align="center" style="padding: 10px 0px 10px 0px; background-color:coral; color: white;border: 1.5px solid white;">
  -- Welcome to Car Repair Shop --
  </h1>
	
   <div class="header" style="width: 30%;">
  		<h2>Register</h2>
   </div>

   <form method="post" action="register.php" style="width: 30%;">
   	<?php include('errors.php') ?>
   	<div class="input-group" style="float: left;">
   		<label>Username</label>
   		<input type="text" name="username" value="<?php echo $username; ?>">
   	</div>
	   <div class="input-group" style="float: right;">
	  	  <label>Email</label>
	  	  <input type="email" name="email" value="<?php echo $email; ?>">
	  	</div>
	  	<div class="input-group" style="float: left;">
	  	  <label>Address</label>
	  	  <input type="text" name="address" value="<?php echo $address; ?>">
	  	</div>
	  	<div class="input-group" style="float: right;">
	  	  <label>Phone</label>
	  	  <input type="text" name="phone" pattern="[0-9]+" value="<?php echo $phone; ?>">
	  	</div>
	  	<div class="input-group" style="float: left;">
   		<label>Car License No.</label>
   		<input type="text" name="car_license_no" value="<?php echo $car_license_no; ?>">
   	</div>
	   <div class="input-group" style="float: right;">
	  	  <label>Car Engine No.</label>
	  	  <input type="text" name="car_engine_no" pattern="[0-9]+" value="<?php echo $car_engine_no; ?>">
	  	</div>
	  	<div class="input-group" style="float: left;">
	  	  <label>Password</label>
	  	  <input type="password" name="password_1">
	  	</div>
	  	<div class="input-group" style="float: right;">
	  	  <label>Confirm password</label>
	  	  <input type="password" name="password_2">
	  	</div>
	  	<div class="input-group">
	  	  <button type="submit" class="btn" name="reg_user">Register</button>
	  	</div>
	  	<p>
	  		Already a member? <a href="login.php">Sign in</a>
	  	</p>
	  </form>

</body>
</html>