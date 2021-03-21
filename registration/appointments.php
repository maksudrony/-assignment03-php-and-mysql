<?php 
  session_start();
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];  

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  //Handling cancel appointment button
  if(isset($_POST['appointment_cancel_button'])){
  $_SESSION['appointment_id']=$_POST['radio_appointments'];
  header('location: appointment_cancel_confirmation.php');
  }

?> 
 
<!DOCTYPE html>
<html>
<head>
	<title>My appointments</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body style="background-image:url(car2.jpg); width:100%; background-size: cover;"
>
<div class="header">
	<h2>My Appointments Page</h2>
</div>
<div class="content">
	<?php  if (isset($_SESSION['username'])) : ?>
  	<p style="float: right;">
    <a href="index.php" style="color: blue;">Create Appointment</a>&nbsp; 
    <a href="appointments.php?logout='1'" style="color: red;">Logout</a>
   </p><br><br> 

   <!-- My appointments fetch from db --> 
	  <?php 
	  $db = mysqli_connect('localhost', 'root', '', 'registration');
	  $query = 
	  "SELECT a.appointment_id,a.mechanic_id,m.mechanic_name,a.date 
   FROM appointments as a
   INNER JOIN mechanics as m
    on a.mechanic_id=m.mechanic_id
   WHERE user_id='$user_id'
   ORDER BY a.date";
	  $result = mysqli_query($db,$query) or die($query."<br/><br/>".mysqli_error($db));
	  ?>
    <!-- Confirmation message pop up div -->
    <?php  if (isset($_SESSION['confirmation'])) : ?>  
    <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['confirmation'];
            unset($_SESSION['confirmation']);
          ?>
        </h3>
      </div> 
    <?php endif ?>
    
    <!-- My appointments div --> 
	  <?php  if (mysqli_num_rows($result)>=1) : ?>   
    <p>You have total <?php echo mysqli_num_rows($result)?> appointments booked in the near future...</p>
    <h2 align="center" style="margin-top: 20px; margin-bottom: 10px;">--- Appointments List ---</h2>
    <p align='center'>
     <form style="width: 75%;border: none;" method="post"> 
      <table align="center" border="1px" style="width:100%; line-height:45px;">
        <t>
        <th>Select</th>
        <th>Date</th>
        <th>Mechanic's Name</th>
        <th>Mechanic's ID</th>
        </t>
        <?php while($rows=mysqli_fetch_assoc($result))
        {
        ?>
        <tr align="center">
        	<td><input type="radio" name="radio_appointments" value="<?php echo $rows['appointment_id'] ?>" required></td>
        	<td><?php echo $rows['date'] ?></td>
        	<td><?php echo $rows['mechanic_name'] ?></td>
         <td><?php echo $rows['mechanic_id'] ?></td>   
        </tr>
       <?php 
       }
       ?>    
      </table>

      <br><p align="center">
      	<input type=submit name="appointment_cancel_button" value="Cancel Appointment !" style="width:40%; padding: 10px;">
      </p>
     </form>
     </p> 
   <?php endif ?>


   <?php  if (mysqli_num_rows($result)==0) : ?>
   	<p>You don't have any appointment with a mechanic. To book a mechanic right now,  
    <a href="index.php"> click here</a>
   	</p>
   <?php endif ?>  	
 <?php endif ?>
</div>

</body>
</html>