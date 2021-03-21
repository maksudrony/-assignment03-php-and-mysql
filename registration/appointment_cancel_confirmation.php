<?php
session_start(); $appointment_id=$_SESSION['appointment_id'];
if (isset($_POST['confirm'])) {
    if ($_POST['confirm'] == 'Yes') {
       $db = mysqli_connect('localhost', 'root', '', 'registration');
	   $query="DELETE FROM appointments WHERE appointment_id='$appointment_id'";
	   if (mysqli_query($db, $query)) {
	    //echo "Selected appointment has been canceled successfully.";
	    $_SESSION['confirmation']="Selected appointment has been canceled successfully.";
	   } 
	   else {
	    //echo "Your request can't not be processed at the moment. Please try again.. "."<br>".mysqli_error($db);
	    $_SESSION['confirmation']="Your request can't not be processed at the moment. Please try again.. ";
	   }
	   header('location: appointments.php');
    }
    else if($_POST['confirm'] == 'No') {
        header('location: appointments.php');
    } 
}
?>

<html>
<head>
<title>Cancel Appointment</title>
</head>

<body style="background-image:url(car2.jpg); width:100%; background-size: cover;"
>
<form method="post" style="width: 70%; text-align: center; margin: 200px;">
<h1 style="color: red; background-color: white; border: 1px solid #B0C4DE; border-radius: 8px 8px 8px 8px; padding: 15px;">
Are you sure you want to cancel the appointment?
</h1>	
<input type="submit" name="confirm" value="Yes" style="padding: 20px; width: 20%; margin-right: 10px;">
<input type="submit" name="confirm" value="No" style="padding: 20px; width: 20%;"><br/>
</form>
</body>
</html>