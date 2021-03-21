<?php 
  session_start();  

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

  if(isset($_POST['confirm_edit_button'])){
    $appointment_id=$_SESSION['appointment_id'];
    $mechanic_name = $_POST['mechanic_name'];
    $date = $_POST['date'];
    
    //Getting selected mechanic's mechanic_id by mechanic_name
    $db = mysqli_connect('localhost', 'root', '', 'registration');
    $result = mysqli_query($db,"SELECT `mechanic_id` FROM `mechanics` WHERE `mechanic_name` = '$mechanic_name'") or die($query."<br/><br/>".mysqli_error($db));
    $row = mysqli_fetch_array($result); 
    $mechanic_id = $row[0];

    //Requesting the edit update
     $query="UPDATE appointments SET mechanic_id='$mechanic_id', date='$date' WHERE appointment_id='$appointment_id'";
     if (mysqli_query($db, $query)) {
      $confirmation="The appointment has been modified successfully.";
     } 
     else {
       $confirmation="Your request can't not be processed at the moment. Please try again.. ";
     }
     $_SESSION['confirmation']= $confirmation;
     header('location: admin_index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background-image:url(car2.jpg); width:100%; background-size: cover;">
<div class="header" style="width: 40%;">
  <h2>Edit Appointment Page</h2>
</div>
<div class="content" style="width: 40%;">
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

 <?php  if (isset($_POST['edit_appointment_button'])) : ?>

    <!-- Getting selected appointment data from DB -->
    <?php 
    $appointment_id=$_POST['radio_all_appointments'];
    $_SESSION['appointment_id']="$appointment_id";

    $db = mysqli_connect('localhost', 'root', '', 'registration');
    $query = 
    "SELECT a.appointment_id,u.username,u.phone_no,u.car_license_no,m.mechanic_name,a.date 
   FROM appointments as a
   INNER JOIN mechanics as m
    on a.mechanic_id=m.mechanic_id
   Inner JOIN users as u  
    on a.user_id=u.user_id
   WHERE a.appointment_id='$appointment_id' 
   ORDER BY a.date";
    $result = mysqli_query($db,$query) or die($query."<br/><br/>".mysqli_error($db));

    while($rows=mysqli_fetch_assoc($result)) {
      $username=$rows['username'];$phone_no=$rows['phone_no'];$car_license_no=$rows['car_license_no'];$mechanic_name=$rows['mechanic_name'];$date=$rows['date'];
    }
    ?>
    
    <!-- Top right nav bar -->
    <p style="float: right;">
    <a href="admin_index.php" style="color: blue;">All Appointments</a>&nbsp; 
    <a href="index.php?logout='1'" style="color: red;">Logout</a>
    </p><br>
    
    <!-- Appointment info div -->
    <h3 align="center">-- Appointment Information --</h3>  
    <form method="post" style="width: 50%; padding-top: 0px; padding-bottom: 5px;margin-top: 5px;margin-bottom: 20px; border-radius: 3px 3px 3px 3px; border: 1px solid black;">
    <div class="input-group">
      <label>Client</label>
      <input type="text" name="username" value="<?php echo $username; ?>" readonly>
    </div>
     <div class="input-group">
        <label>Phone</label>
        <input type="text" name="phone_no" value="<?php echo $phone_no; ?>" readonly>
      </div>
      <div class="input-group">
        <label>Car Registration No.</label>
        <input type="text" name="car_license_no" value="<?php echo $car_license_no; ?>" readonly>
      </div>
      <div class="input-group">
        <label>Assign Different Mechanic:</label>
         <select id="soflow" name="mechanic_name">     
         <?php 
          $query = 
            "SELECT mechanic_name from mechanics";
            $result = mysqli_query($db,$query) or die($query."<br/><br/>".mysqli_error($db));

          while($rows=mysqli_fetch_assoc($result)) {
         ?>
         <option value="<?php echo $rows['mechanic_name']?>"
           <?php echo ($mechanic_name==$rows['mechanic_name'])?"selected":"";?>>
           <?php echo $rows['mechanic_name']?>
         </option>
         <?php 
          }
         ?>
         </select>
      </div>
      <div class="input-group">
      <label>Change Appointment Date:</label>
      <input type="date" name="date" value="<?php echo $date; ?>"> </div>
      
      <p>
        <input type=submit name="confirm_edit_button" value="Confirm Edit" style="width:40%; padding: 10px;margin-top: 5px;margin-bottom: 8px;">
      </p>
    </form>
 <?php endif ?>
</div>

</body>
</html>  