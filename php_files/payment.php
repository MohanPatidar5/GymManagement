<?php 
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>
<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
$emailErr="";


if(isset($_POST['submit']))
 { 
  $idno=$_POST['idno'];
  $name=$_POST['name'];
  $email=$_POST['email'];
  $rupee=$_POST['rupee'];
  $day=date("Y/m/d");
  

if (empty($_POST["email"])) {
    echo "<script>alert('email is required ')</script>";
    $emailErr="ram";
  }
   else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>alert('invalid email ')</script>";
    }
  }
if (empty($idno)||empty($name)||empty($email)||empty($rupee)) {

  	echo "<script>alert('please  full fill from ')</script>";
  }
  else
  {
  	if(!($idno=="") && !($name=="")&&!($email=="")&&!($rupee=="")&&($emailErr==""))
 	{mysqli_query($conn,"INSERT INTO payment (idno,name,email,day,rupee) 
    VALUES ('$idno','$name','$email','$day','$rupee')");
     
     $subject="gym management system";
     $txt = "Welcome  !!
             $name your payment is successfull and your payment is recived Rs $rupee/-
            Thankyou !!!";
     $headers = "From: gymmanagement2018@gmail.com" . "\r\n" .
     "CC: $email";

       if (mail($email,$subject,$txt,$headers)) {
	  echo "<script>alert('message is successfully send in your email id ')</script>";
     }
     else
     {
	 echo "<script>alert('problem message is not send  ')</script>";
     }

    






}
  }
 } 



 ?>

<!DOCTYPE html>
<html>
<head>
	<title>GYM managment</title>

	<link rel="stylesheet" type="text/css" href="css/payment.css">
</head>
<body>
	<header>
		<nav>
		<h1>gym managment</h1>
		<ul id="nav">
			<li> <a class="homered" href="mainpage.php"> Home</a> </li>
			<li> <a class="homeblack" href="registr.php"> Add member</a> </li>
			<li> <a class="homeblack" href="memberinfo.php"> Member info</a> </li>
			<li> <a class="homeblack" href="login.php"> Add Admin</a> </li>
			<li> <a class="homeblack" href="payment.php"> Payment </a> </li>
			<li> <a class="homeblack" href="detail.php">Cust Detail</a> </li>
			<li> <a class="homeblack" href="paymentdetail.php"> Payment Detail</a> </li>
			<li> <a class="homeblack" href="contact.php"> Contacts</a> </li>
			<li> <a class="homeblack" href="attendence.php">attendace</a> </li>
			<li> <a class="homeblue" href="logout.php"> log out</a> </li>
		</ul>
	    </nav>
	</header>
	<div class="divider"></div>
   <div class="div1"></div>
   <div class="alert">
  <h1 align="center">Welcome!!</h1> <h3 align="center">Gym management 2018</h3>
  <span style="color: lime;font-size: 20px;font-style:bold;">*Fees Structure*</span><br><br>
<span style="color:  #0000ff;font-style: bold;">200 Rupees For 1  Month. </span><br><br>
<span style="color: yellow;font-style: bold;">500 Rupees For 3  Month. </span><br><br>
<span style="color:	#00ffff;font-style: bold;">1000 Rupees For 6 Month. </span><br><br>
<span style="color:#000d1a;font-style: bold;">2000 Rupees For 1 year. </span><br><br><br>
<h2 align="center">!!Thank You!!</h2>

</div>
	<div class="box">
    <h2>Payment</h2>
    <form action="payment.php" method="post">
  <div class="inputbox">
  <input type="text" name="idno" required="">
  <label>id no</label>
  	</div>
  	 <div class="inputbox">
  <input type="text" name="name" required="">
  <label>name</label>
  	</div>
  	<div class="inputbox">
  <input type="text" name="email" required="">
  <label>Email id @ gmail.com</label>
  	</div>
  	 <div class="inputbox">
  <input type="text" name="rupee" required="">
  <label>₹ </label>
  	</div>
  	<input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
  
  	</form>
</div>	
  	


</body>
</html>