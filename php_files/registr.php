<?php
  require "database\dbconnect.php";
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

$fnameErr=$lnameErr=$idnoErr=$genderErr=$weightErr=$heightErr=$ageErr=$batchErr=$addressErr=$joindateErr=$mobilenoErr=$planErr="";
 $nameErr="";$passErr="";
if(isset($_POST['Submit']))
 { 

   $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $idno=$_POST['idno'];
  $gender=$_POST['gender'];
  $weight=$_POST['weight'];
  $height=$_POST['height'];
  $age=$_POST['age'];
  $batch=$_POST['batch'];
  $address=$_POST['address'];
  $joindate=date("Y/m/d");
  $mobileno=$_POST['mobileno'];
  $plan=$_POST['plan'];
  $email=$_POST['email'];
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


  if(empty($fname)||empty($lname)||empty($gender)||empty($weight)||empty($height)||empty($age)||empty($batch)||empty($address)||empty($joindate)||empty($mobileno)||empty($plan))
{
	if (empty($_POST["fname"])) {
    $fnameErr = " First Name is required";}
else {
    $fname = test_input($_POST["fname"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
      $fnameErr = " Only letters and white space allowed"; 
    }  
    }
     if (empty($_POST["lname"])) {
    $lnameErr = "Last Name is required";}
else {
    $lname = test_input($_POST["lname"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
      $lnameErr = " Only letters and white space allowed"; 
    }  
    }

   if (empty($_POST["gender"])) {
    $genderErr = " gender is required";}   
    if (empty($_POST["weight"])) {
    $weightErr = "weight is required";} 
    if (empty($_POST["height"])) {
    $heightErr = " height is required";}
    if (empty($_POST["age"])) {
    $ageErr = " age is required";}
    if (empty($_POST["batch"])) {
    $batchErr = " batch is required";}
    if (empty($_POST["joindate"])) {
    $joindateErr = " joindate is required";}
    if (empty($_POST["mobileno"])) {
    $mobilenoErr = " mobile no is required";}
    if (empty($_POST["plan"])) {
    $planErr = " plan is required";}
    if (empty($_POST["address"])) {
    $addressErr = " address required";}
}
 $q="select * from registration where idno='$idno'";
 $result=mysqli_query($conn,$q);

 if (mysqli_num_rows($result)) {
      echo "<script>alert('this id number invalid ')</script>";
 }

 else
 {  
 	if(empty($fname)||empty($lname)||empty($gender)||empty($weight)||empty($height)||empty($age)||empty($batch)||empty($address)||empty($joindate)||empty($mobileno)||empty($plan)){
         echo "<script>alert('full fill from is requrement ')</script>";
 	}
 	else{

        $r="select * from registration where fname='$fname' and lname='$lname' and email='$email'";
      $res=mysqli_query($conn,$r);

      if ((mysqli_num_rows($res))){echo "<script>alert('Already Done Your registration in gymmanagement2018 ')</script>";}
      else{

 	mysqli_query($conn,"INSERT INTO registration (fname,lname,idno,gender,weight,height,age,batch,address,joindate,mobileno,plan,email) 
    VALUES ('$fname','$lname','$idno','$gender','$weight','$height','$age','$batch','$address','$joindate','$mobileno','$plan','$email')");
  
     $c= mysqli_insert_id($conn); 

      mysqli_close($conn);

    echo "<script>alert('success fully your registration and your idno is=$c')</script>";
    $subject="gym management system";
     $txt = "Welcome  !!
             $fname $lname your registration is successfull and your gym id is $c .Thankyou for joining us....!!!";
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
}

?>
<!DOCType html>
<html>
<head>
<title> Registration page</title>
<link rel="stylesheet" href="css/coding.css">
</head>
<body  bgcolor='steelblue'>
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
<div id="mohan">
<center><h2>Registration From</h2>
<marquee behavior='scroll' bgcolor="white"><font size='25'><b>Welcome To India's No.1  Gym Fitness GOOD News the gym will be 24X7 Shortly </b> </font> </marquee>
<img src="image/ksl.JPG" class ="PICGYM"/>
</center>
<from class="MYFROM">
<form   action="registr.php" method="POST">
<label><b>Firstname:</b></label>
<input name="fname" Type="text" class="INPUT" placeholder="Enter your firstname"/>
<label><b>Lastname:</b></label>
<input name="lname" Type="text" class="INPUT" placeholder="Enter your Lastname"/><span class="error"> <?php echo $lnameErr;?></span> <br>
<span class="error"> <?php echo $fnameErr;?></span><br>
<label><b>ID-NO:</b></label>
<input name="idno" Type="text" class="INdo" placeholder="No Required Automatic genareted"/> 
<label><b>Gender:</b></label>
 <input type="radio" name="gender" value="male" checked><b>Male</b> 
  <input type="radio" name="gender" value="female"> <b>Female</b>  
  <span class="error"> <?php echo $genderErr;?></span> <br><span class="error"> </span><br>
<b>Weight:</b></label>
<input name="weight" Type="text" class="weight" placeholder="Type your Weight"/>
<label><b>Height:</b></label>
<input name="height" type="text" class="weight" placeholder="Type your Height in inch "/>
<span class="error"> <?php echo $heightErr;?></span><span class="error"> <br><?php echo $weightErr;?></span><br>
<label><b>Age:</b></label>
<input  name="age" Type="text" class="age" placeholder="Enter Your Age"/>
<label><b>Batch:</b></label>
<input list="batch" name="batch" class="batch">
 <datalist id="batch">
    <option value="5 AM TO 7 AM">
    <option value="7 AM TO 9 AM">
    <option value="4 PM TO 6 PM">
    <option value="6 PM TO 8 PM">
  </datalist><span class="error"> <?php echo $batchErr;?></span> <br><span class="error"> <?php echo $ageErr;?></span> <br>
<label><b>Address:</b></label>
<input name="address" Type="text" class="add" placeholder="Enter your address"/>
<label><b>Join Date:</b></label>
<input name="joindate" Type="text" class="INPUT" placeholder="YY/mm/dd"/>
<span class="error"> <?php echo $joindateErr;?></span><br><span class="error"> <br><?php echo $addressErr;?></span> <br>
<label><b>Mobile no:</b></label>
<input name="mobileno" Type="text" class="INPUT" placeholder="Enter your mobile no"/>
<label><b>Plan Select:</b></label>
<input list="plan" name="plan" class="plan">
 <datalist id="plan">
    <option value="1 Month">
    <option value="3 Month">
    <option value="6 Month">
    <option value="1 Year">
  </datalist><span class="error"> <?php echo $planErr;?></span><br> <span class="error"> <?php echo $mobilenoErr;?></span> <br>
  <label><b>Email:</b></label>
<input name="email" Type="text" class="INcr" placeholder="Enter your valid email"/><br>
<input name="Submit" Type="Submit" id="Signup_btn" value="Submit"/> <br>
<p class="already"> Already a member? <a href="mainpage.php"><span style="color: white">Home</span></a></p>
</form>
</from>
</div>
</body>
</html>
















































 



