<?php 
  session_start(); 
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


?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background-image:url(car2.jpg); width:100%; background-size: cover;">
<div class="header">
  <h2>Admin Home Page</h2>
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

  <?php if (isset($_SESSION['confirmation'])) : ?>
    <div class="error success" >
      <h3>
        <?php 
          echo $_SESSION['confirmation']; 
          unset($_SESSION['confirmation']);
        ?>
      </h3>
    </div>
  <?php endif ?>  

  <!-- logged in user information -->
  <?php  if (isset($_SESSION['username'])) : ?>
   <p style="float: right;">
     <a href="index.php?logout='1'" style="color: red;">Logout</a>
   </p><br>
   <p>Welcome <strong><?php echo $_SESSION['username']."..."; ?></strong></p>
   
   <!-- All appointments fetch from db --> 
    <?php 
    $db = mysqli_connect('localhost', 'root', '', 'registration');
    $query = 
    "SELECT a.appointment_id,u.username,u.phone_no,u.car_license_no,m.mechanic_name,a.date 
   FROM appointments as a
   INNER JOIN mechanics as m
    on a.mechanic_id=m.mechanic_id
   Inner JOIN users as u  
    on a.user_id=u.user_id
   ORDER BY a.date";
    $result = mysqli_query($db,$query) or die($query."<br/><br/>".mysqli_error($db));
    ?>
   
   <!-- All appointments div --> 
    <?php  if (mysqli_num_rows($result)>=1) : ?>
   <p align='center'>
     <form style="width: 75%;border: none;" method="post" action="edit_appointment.php"> 
      <table align="center" border="1px" style="width:100%; line-height:45px;">
        <tr><th colspan="6"><h2>-- All Appointments list ---</h2></th></tr>
        <t>
        <th>Select</th>
        <th>Client</th>
        <th>Phone</th>
        <th>Car Reg.</th>
        <th>Mechanic</th>
        <th>Date</th>
        </t>
        <?php while($rows=mysqli_fetch_assoc($result))
        {
        ?>
        <tr align="center">
          <td><input type="radio" name="radio_all_appointments" value="<?php echo $rows['appointment_id']?>" required></td>
          <td><?php echo $rows['username'] ?></td>
          <td><?php echo $rows['phone_no'] ?></td>
          <td><?php echo $rows['car_license_no'] ?></td>
          <td><?php echo $rows['mechanic_name'] ?></td>
          <td><?php echo $rows['date'] ?></td>
        </tr>
       <?php 
       }
       ?>    
      </table><br>
      <input type=submit name="edit_appointment_button" value="Edit Appointment" style="width:40%; padding: 10px;">
      </form>
     </p>
   <?php endif ?> 

   <?php  if (mysqli_num_rows($result)==0) : ?>
    <p>Nobody has booked any mechanic yet.
    </p>
   <?php endif ?> 
  <?php endif ?>
</body>
</html>  