<?php 
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>
<?php  
 $nameErr=$passErr="";
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if(isset($_POST['submit']))
 { 
 	$name=$_POST['name'];
 	$password=$_POST['password'];


	
 if (empty($_POST["name"])) {
    $nameErr = " Name is required";}
else {
    $name = test_input($_POST["name"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = " Only letters and white space allowed"; 

     
    }  
    }
  if (empty($_POST["password"])) {
    $passErr = " password is required";}
  
  

 $q="select * from login where u_name='$name' && password='$password' ";
 $result=mysqli_query($conn,$q);

 if (mysqli_num_rows($result)) {
       echo "<script>alert('you are already admin')</script>";	
 }

else
 {
   if(!($name=="" && $password=="")&&!$name==""&&!$password==""&& $nameErr=="")
 	{mysqli_query($conn,"INSERT INTO login (u_name,password) 
    VALUES ('$name','$password')");
 echo "<script>alert('Successfully add admin')</script>";

}
 	
 	
 }
}

?>

<!DOCTYPE html>
<html>
<head>
<title> Add Admin Page</title>
<link rel="stylesheet" href="css/coding.css">
</head>
<body  >
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
	<div class="box">
    <h2>New Admin From</h2>
    <form action="login.php" method="post">
  <div class="inputbox">
  <input type="text" name="name" required="">
  <label>username</label>
  	</div>
  	 <div class="inputbox">
  <input type="password" name="password" required="">
  <span class="error"> <?php echo $nameErr;?></span> <br>
  <label>password</label>
  	</div>
  	<input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
    <span class="error"> <?php echo $passErr;?></span> <br>
  	</form>
</div>





</body>
</html>

