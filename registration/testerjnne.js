/*<!--

<button class="btn" style="width:100%; padding: 12px; ">APPOINT !</button>

<input type=submit value="APPOINT !" style="width:100%; padding: 12px; ">

<p align='center'>
     <table align="center" border="1px" style="width:100%; line-height:45px;">
      <tr><th colspan="4"><h2>Mechanics list</h2></th></tr>
      <t>
      <th>Mechanic's ID</th>
      <th>Mechanic's Name</th>
      <th>Appointment Day</th>
      </t>
      <?php while($rows=mysqli_fetch_assoc($result))
      {
      ?>
      <tr align="center">
        <td><?php echo $rows['mechanicID'] ?></td>
        <td><?php echo $rows['mechanic_name'] ?></td>
        <td><input type="date" name="appointment_date[]" placeholder="dd-mm-yyyy" pattern="\d{1,2}-\d{1,2}-\d{4}" style="width:90%; padding: 15px;"></td>
        <td><input type=submit name="appoint_button[]>" value="APPOINT !" style="width:100%; padding: 17px; "></td>
      </tr>
      <?php 
      }
      ?>    
      </table>
     </p>



     $dateErr="";   
//Handling Appointment request
if (isset($_POST['appoint_button'])) {
if (empty($_POST["appointment_date"])) {
    $dateErr = "*Date is required";
  }
}

<span class="errorOnAppoint"><?php echo $dateErr;?></span><br>





style="background-image:url(car2.jpg); width:100%; background-size: cover;"


<br>
<?php
print_r($_SESSION);
?>
-->


form self a redirect er jnne
<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>


edit mechanic div
<div class="input-group">
        <label>Assign Different Mechanic:
       <input list="mechanics" name="mechanic_name" placeholder="<?php echo $mechanic_name; ?>" />
      </label>
      <datalist id="mechanics">
      <?php 
        $query = 
          "SELECT mechanic_name from mechanics";
          $result = mysqli_query($db,$query) or die($query."<br/><br/>".mysqli_error($db));

        while($rows=mysqli_fetch_assoc($result)) {
      ?>
      <option value="<?php echo $rows['mechanic_name']?>">
      <?php 
        }
      ?>
      </datalist>
      </div>