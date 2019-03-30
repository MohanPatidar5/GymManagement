<?php 
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>
<?php
$num_rows="";
$sql="select count(idno) AS total from registration";
	$result = mysqli_query($conn, $sql);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];

      
?>


<!DOCTYPE html>
<html>
<head>
	<title>member info</title>
	<style type="text/css">
		
    table {
    	border-collapse: collapse;
    	width: 100%;
    	color: red;
    	font-family:monospace;
    	font-size: 25px;
    	text-align: left;
    	margin-top: 50px;
    }
    th{
    	background-color: black;
    	font: italic bold 15px/32px Georgia, serif;
    	color: white;
    }

	</style>
	<link rel="stylesheet" type="text/css" href="css/style1.css">
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
	<div class=krapa>
		<span class="error">total mambers is  <?php echo $num_rows;?></span>
	</div>
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
	
      $sql="select idno ,fname,lname,weight,height,age,batch,address,joindate,mobileno,plan  from registration";

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




      $conn->close();


	 ?>







</table>


</body>
</html>