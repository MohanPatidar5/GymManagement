<?php
session_start();
 require "database\dbconnect.php";
 $conn=mysqli_connect("localhost","root","") or die(mysql_error());
 $db=mysqli_select_db($conn,'db1') or die(mysql_error());

?>
<?php
$num_rows="";
$sql="select sum(rupee) AS total from payment";
	$result = mysqli_query($conn, $sql);
	$values=mysqli_fetch_assoc($result);
	$num_rows=$values['total'];

      
?>

<!DOCTYPE html>
<html>
<head>
	<title>GYM managment</title>
	<style type="text/css">
		
    table {
    	margin-top: 50px;
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
	<div class="divider"></div>
	<div class=krapa>
		<span class="error">total Amount is  <?php echo $num_rows;?></span>
	</div>
	

</body>
</html>
<table >
	<tr>
		<th>idno</th>
		<th>name</th>
		<th>emailid</th>
		<th> date</th>
		<th>payment</th>
		
	</tr>
<?php 
       
      $sql="select idno ,name,email,day,rupee from payment";
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
      


	 ?>
	</table>
	
