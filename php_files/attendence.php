<?php 
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>
<?php
$a="";
// Prints the day

// Prints the day, date, month, year, time, AM or PM
$a= date("l jS  F Y") . "<br>";
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

	<link rel="stylesheet" type="text/css" href="css/attendence.css">
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
	<div class="warning">
	<span class="error"> <?php echo $a;?></span>
</div>
	<div class="box">
         <form action="attendence.php" method="post">
         	<h1 align="center">Attendance</h1>
         	<span class="imj"> <?php echo $a;?></span>
         <div class="inputbox">
           <input type="text" name="idno" required="">
             <label>Enter your id no </label>
  	     </div>
           <input type="radio" name="pa" value="present"   checked><span style="color: red;font-size: 20px;">Present</span>> 
           <input type="radio" name="pa" value="absence"> <span style="color: yellow;font-size: 20px;">Absence</span>>  
           <br><br>
  	     <input type="submit" name="submit" value="submit">
  	     <a href="attendencedetail.php"><div class="alert">View</div></a>

  	 </div>

  	 
  	</form>
  	

</body>
</html>

<?php 
      if(isset($_POST['submit']))
      { 
            $idno=$_POST['idno']; 
            $pa=$_POST['pa']; 
            $date=date("Y/m/d");
            
      $q="select * from registration where idno='$idno'";
      $result=mysqli_query($conn,$q);

      if (!(mysqli_num_rows($result))){echo "<script>alert('Your registration is not in gymmanagement 2018 ')</script>";}
      else{

       $sql="select fname,lname,batch from registration where idno='$idno'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
       while ($row=$result-> fetch_assoc()) { $name=$row["fname"];$lname=$row["lname"];$batch=$row["batch"];} 
       }
        $r="select * from attendence where idno='$idno' and date='$date'";
      $res=mysqli_query($conn,$r);

      if ((mysqli_num_rows($res))){echo "<script>alert('Already Done Your attendance ')</script>";}
      else{

     if(!empty($name)){   
     mysqli_query($conn,"INSERT INTO attendence(idno,name,lname,batch,date,pa) 
     VALUES ('$idno','$name','$lname','$batch','$date','$pa')");}
 }
 }
 
}
            
       
     

	 ?>



