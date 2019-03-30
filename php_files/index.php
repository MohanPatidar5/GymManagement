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
  return $data;}

if(isset($_POST['submit']))
 { 
  $name=$_POST['name'];
  $password=$_POST['password'];


 
 if (empty($_POST["name"])) {
    $nameErr = " Name is required";}
else {
    $name = test_input($_POST["name"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "  Only letters and white space allowed"; 
    }  
    }
  if (empty($_POST["password"])) {
    $passErr = " password is required";}
   
  

 $q="select * from login where u_name='$name' && password='$password' ";
 $result=mysqli_query($conn,$q);

 if (mysqli_num_rows($result)) {
       header("location:mainpage.php");
 }

else
 {

 
   echo "<script>alert('username and password  is wrong ')</script>";
 
 
 }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>GYM MANAGEMENT SYSTEM </title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<nav>
		<h1>Gym Managemant Systems </h1>
	    </nav>
	</header>
	<div class="div1"></div>
	<div class="box">
    <h2>Login</h2>
    <form action="index.php" method="post">
  <div class="inputbox">
  <input type="text" name="name" required="">
  <label>username</label>
  	</div>
  	 <div class="inputbox">
  <input type="password" name="password" required="">
  <span class="error"> <?php echo $nameErr;?></span> <br>
  <label>password</label>
  	</div>
  	<input type="submit" class="button" name="submit" value="Login">
    <input type="reset" name="reset" value="Reset">
    <span class="error"> <?php echo $passErr;?></span> <br>
  	</form>
</div>

</body>
</html>



