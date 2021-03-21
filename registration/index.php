<?php 
  session_start(); 
  $username = $_SESSION['username']; 
  $user_id = $_SESSION['user_id']; $errors = array(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }


//Handling Appointment request 
if (isset($_POST['appoint_button'])) {
 $db = mysqli_connect('localhost', 'root', '', 'registration');
 $mechanic_id= test_input($_POST['radio_mechanics']);
 $appointment_date=$_POST['appointment_date'];

 //Checking if mechanic already booked on that day
 $query = "SELECT * FROM appointments WHERE user_id='$user_id' AND mechanic_id='$mechanic_id' AND date='$appointment_date'";
 $results = mysqli_query($db, $query);
 if (mysqli_num_rows($results)==1) { 
 //echo "You already booked desired mechanic on $appointment_date."; 
 array_push($errors, "You already booked desired mechanic on $appointment_date.");
 }
 else{
  //Checking if mechanic fully booked on that day
  $query = "SELECT * FROM appointments WHERE mechanic_id='$mechanic_id' AND date='$appointment_date'";
  $results = mysqli_query($db, $query);
  if (mysqli_num_rows($results) < 4) { 
   //Finally creating an appointment record
   $query = "INSERT INTO appointments (user_id,mechanic_id,date) VALUES ('$user_id','$mechanic_id','$appointment_date')";
   if (mysqli_query($db,$query)) {
       //echo "The appointment was created successfully";
       $_SESSION['confirmation']="The appointment was created successfully";
       header("location: appointments.php");
   } else {
       echo "Error: " . $query . "<br>" . mysqli_error($db);
   }
  }
  else{
   //echo "Desired mechanic is fully booked on $appointment_date. Please try booking him on another date.";
   array_push($errors, "Desired mechanic is fully booked on $appointment_date. Please try booking him on another date.");
  }
 }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image:url(car2.jpg); width:100%; background-size: cover;"
>

<div class="header">
	<h2>Home Page</h2>
</div>
<div class="content">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p style="float: right;">
      <a href="appointments.php?appointments='1'" style="color: blue;">My Appointments</a>&nbsp; 
      <a href="index.php?logout='1'" style="color: red;">Logout</a>
     </p><br><br>
     <?php include('errors.php'); ?> 
     <p>Welcome <strong><?php echo $_SESSION['username']."..."; ?></strong></p>

     <!-- Book a mechanic div -->
      <h2 align="center" style="margin-bottom: 20px;">--- Book a Mechanic Today ---</h2>
      <?php 
      $db = mysqli_connect('localhost', 'root', '', 'registration');
      $query = "SELECT * from mechanics";
      $result = mysqli_query($db,$query);
      ?>


     <p align='center'>
     <form style="width: 75%;border: none;" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
      <table align="center" border="1px" style="width:100%; line-height:45px;">
        <tr><th colspan="3"><h2>Mechanics list</h2></th></tr>
        <t>
        <th>Select</th>
        <th>Mechanic's ID</th>
        <th>Mechanic's Name</th>
        </t>
        <?php while($rows=mysqli_fetch_assoc($result))
        {
        ?>
        <tr align="center">
          <td><input type="radio" name="radio_mechanics" value="<?php echo $rows['mechanic_id']?>" required></td>
          <td><?php echo $rows['mechanic_id'] ?></td>
          <td><?php echo $rows['mechanic_name'] ?></td>
        </tr>
       <?php 
       }
       ?>    
      </table>

      <br>
      <p align="left"><b>Date:</b><br><input type="date" name="appointment_date" placeholder="dd-mm-yyyy" pattern="\d{1,2}-\d{1,2}-\d{4}" style="width:50%; padding: 15px;" required="">
      <input type=submit name="appoint_button" value="APPOINT !" style="width:43%; padding: 17px; ">
      </p>
     </form>
     </p> 
     
    <?php endif ?>
</div>

<br><p style="float: right;">copyright@nazmumasood96 &nbsp;&nbsp;|</p>
</body>
</html>