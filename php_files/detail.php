<?php 
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>


<!DOCTYPE html>
<html>
<head>
	<title>GYM managment</title>
	<style type="text/css">
		
    table {
    	margin-top: 250px;
    	border-collapse: collapse;
    	width: 100%;
    	color: red;
    	font-family:monospace;
    	font-size: 20px;
    	text-align: left;
    }
    th{
    	background-color: black;
    	font: italic bold 15px/32px Georgia, serif;
    	color: white;
    }
    .di{
    	margin-top: 10px;
    }
    .data{
    	background-color: black;
    	font: italic bold 15px/32px Georgia, serif;
    	color: white;
    }

	</style>

	<link rel="stylesheet" type="text/css" href="css/detail.css">
</head>
<body>
	<header>
		<nav>
		<h1>gym managment</h1>
		<ul id="nav">
			<li> <a class="homered" href="mainpage.php"> Home</a> </li>
			<li> <a class="homeblack" href="registr.php"> Addmember</a> </li>
			<li> <a class="homeblack" href="memberinfo.php"> Memberinfo</a> </li>
			<li> <a class="homeblack" href="login.php"> Add Admin</a> </li>
			<li> <a class="homeblack" href="payment.php"> Payment </a> </li>
			<li> <a class="homeblack" href="detail.php">CustDetail</a> </li>
			<li> <a class="homeblack" href="paymentdetail.php"> PaymentDetail</a> </li>
			<li> <a class="homeblack" href="contact.php"> Contacts</a> </li>
			<li> <a class="homeblack" href="attendence.php">attendace</a> </li>
			<li> <a class="homeblack" href="logout.php"> logout</a> </li>
			

		</ul>
	    </nav>
	</header>
	<div class="divider"></div>

          <div class="box">
         <form action="detail.php" method="post">
         <div class="inputbox">
           <input type="text" name="idno" required="">
             <label>Enter your id no </label>
  	     </div>
  	     <input type="submit" name="submit" value="submit">
  	     </form>
  	 </div>

  	 
  	
</body>
</html>
<table>
	<tr>
		<th>ID NO</th>
		<th>FNAME</th>
		<th>LNAME</th>
		<th>WEIGHT</th>
		<th>HEIGHT</th>
		<th>AGE</th>
		<th> BATCH TIME</th>
		<th>ADDRESS</th>
		<th>JOIN DATE</th>
		<th>MOB NO</th>
		<th>PLAN</th>
	</tr>
<?php 
      if(isset($_POST['submit']))
      { 
            $id=$_POST['idno']; 
            
       
      $sql="select idno ,fname,lname,weight,height,age,batch,address,joindate,mobileno,plan  from registration where idno='$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while ($row=$result-> fetch_assoc()) {
       	  echo "<tr><td>".$row["idno"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["weight"]."</td><td>".$row["height"]."</td><td>".$row["age"]."</td><td>".$row["batch"]."</td><td>".$row["address"]."</td><td>".$row["joindate"]."</td><td>".$row["mobileno"]."</td><td>".$row["plan"]."</td></tr>"  ;
       }
       echo "</table>";
      }
      else
      {
      	echo "0 result";
      }
      
    }  


	 ?>
	 
	</table>
<table class="di">
	<tr>
		<th>idno</th>
		<th>name</th>
		<th>emailid</th>
		<th>date</th>
		<th>payment</th>
		
	</tr>
<?php 
      if(isset($_POST['submit']))
      { 
            $id=$_POST['idno']; 
            
       
      $sql="select idno ,name,email,day,rupee from payment where idno='$id'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while ($row=$result-> fetch_assoc()) {
       	  echo "<tr><td>".$row["idno"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["day"]."</td><td>".$row["rupee"]."</td><td>"."</td></tr>";  
       }
       echo "</table>";
      }
      else
      {
      	echo "0 result";
      }
      $conn->close();
    }  


	 ?>
	</table>

<!DOCTYPE html>
<html>
<head>
	<title>emailsend</title>
	<link rel="stylesheet" type="text/css" href="css/contact.css">
</head>
<body>
	<form action="detail.php" method="post">
<div class="soap">
 <label><b>Name:</b></label>
<input name="name" Type="text" class="INPUT" placeholder="Enter name"/>
<label><b>Email:</b></label>
<input name="email" Type="text" class="INPUT" placeholder="Enter email "/>
<input name="mohan" Type="Submit" class="dps" id="Signup_btn" value="SEND"/> 
<input type="reset" name="reset" class="dps" value="CANCEL">
</div>
</form>

  
</body>
</html>


<?php
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
$emailErr="";


if(isset($_POST['mohan']))
{

   $name=$_POST['name'];
   $email=$_POST['email'];


	if (empty($_POST["email"])) {
    echo "<script>alert('email is required ')</script>";
  }
   else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script>alert('invalid email ')</script>";
    }
  }
  if (empty($name)||empty($email)) {

  	echo "<script>alert('please  full fill from ')</script>";
  }
  $subject="gym management system";
     $txt = "Welcome  !!
             $name your plan is about to an end 
            Thankyou for joining us....!!!";
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
?>