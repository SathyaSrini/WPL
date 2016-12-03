<?php
session_start();

if(isset($_SESSION['usr_id'])!="") {
	header("Location: http://localhost/home.html");
	exit();
}

include_once 'dbconnect.php';

//set validation error flag as false
$error = false;
/*$isadmin = false;*/
$isactive = true;

//check if form is submitted
if (isset($_POST['signup'])) 
{
	$fname = mysqli_real_escape_string($con, $_POST['fname']);
	$lname = mysqli_real_escape_string($con, $_POST['lname']);
	$email = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
	$city = mysqli_real_escape_string($con, $_POST['city']);
	
	$dob = mysqli_real_escape_string($con, $_POST['dob']);
	list($yyyy,$mm,$dd) = explode('/',$dob);
	
	$cntctno = mysqli_real_escape_string($con, $_POST['cntctno']);

	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$fname)) {
		$error = true;
		$fname_error = "First Name must contain only alphabets and space";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$lname)) {
		$error = true;
		$lname_error = "Last Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if (!checkdate($yyyy,$mm,$dd)) 
	{
        $error = true;
        $dob_error = "Please Enter Valid Date of Birth";
	}
	//eliminate every char except 0-9
	$justNums = preg_replace("/[^0-9]/", '', $cntctno);
	//eliminate leading 1 if its there
	if (strlen($justNums) == 11) $justNums = preg_replace("/^1/", '',$justNums);
	//if we have 10 digits left, it's probably valid.
	if (!(strlen($justNums) == 10))
	{
		$error = true;
        $ph_error = "Please Enter Valid Contact Number";
	}
	if (!preg_match("/^[a-zA-Z ]+$/",$city)) {
		$error = true;
		$city_error = "City must contain only alphabets and space";
	}
	if(strlen($password) < 6) 
	{
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	
		if(ctype_alnum($password))
		{
    		$error = true;
			$password_error = "Password must be alpha-numeric";
		}
	
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	/*if(isset($_POST['adminCheckBox']) && $_POST['adminCheckBox'] == 'Yes') 
	{
		$isadmin = true;
	}*/
	if (!$error) {
		
		mysqli_query($con,"SET foreign_key_checks = 0");

		if(mysqli_query($con,"INSERT INTO login(username,password) VALUES('" . $email . "', '" . md5($password) . "')")) 
		{
			$dob_format = date('Y-m-d',strtotime($dob));

			if(mysqli_query($con,"INSERT INTO userinfo(userid,isadmin,firstname,lastname,dob,contactno,city,isactive) VALUES('" . $email . "','" . $isadmin . "','" . $fname . "','" . $lname . "','" . $dob_format . "','" . $cntctno . "','" . $city . "','". $isactive . "')"))
			{
				$successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
		    }
		} else 
		{
			$errormsg = "Error in registering...Please try again later!";
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Realtor Signup</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
	<meta name="description" content="RealtorLogin">
  	<meta name="keywords" content="Realtor,Homes,Sale,Rent">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  	<link rel="icon" href="favreal.ico" type="image/x-icon">
</head>
<body>
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>    
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
         <li><a href="home.html">Home</a></li>      
        <li><a href="properties.html">Properties</a></li>		
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>	
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
				<fieldset>
					<legend>Sign Up</legend>
					<div class="form-group">
						<label for="fname">First Name</label>
						<input type="text" name="fname" id = "fname" placeholder="Enter First Name" required value="<?php if($error) echo $fname; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($fname_error)) echo $fname_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="lname">Last Name</label>
						<input type="text" name="lname" id = "lname" placeholder="Enter Last Name" required value="<?php if($error) echo $lname; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($lname_error)) echo $lname_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="username">Email</label>
						<input type="text" name="username" id = "username" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($email_error)) echo $email_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="dob">Date of Birth</label>
						<input type="text" name="dob" id = "dob" placeholder="Enter date of birth (MM/DD/YYYY)" required value="<?php if($error) echo $dob; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($dob_error)) echo $dob_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="cntctno">Contact Number</label>
						<input type="text" name="cntctno" id = "cntctno" placeholder="Enter 10 digit Contact Number" required value="<?php if($error) echo $cntctno; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($ph_error)) echo $ph_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="city">City</label>
						<input type="text" name="city" id = "city" placeholder="Enter your city" required value="<?php if($error) echo $city; ?>" class="form-control" />
						<span class="text-danger"><?php if (isset($city_error)) echo $city_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" name="password" id = "password" placeholder="Password (Minimum 6 characters)" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo $password_error; else echo "";?></span>
					</div>
					<div class="form-group">
						<label for="cpassword">Confirm Password</label>
						<input type="password" name="cpassword" id = "cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; else echo "";?></span>
					</div>
<!-- 					<div class="form-group">
					<label for="adminCheckBox">Admin account</label>
					<input type="checkbox" name="adminCheckBox" value="Yes"/>
					</div> -->
					<div class="form-group">
						<input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>
</div>
<script src="scripts/jquery-1.10.2.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
var somethingChanged = false;	
$('#cntctno').change(function() { 
		
		var cntctno=document.getElementById("cntctno").value;	
		var regex = /^[0-9-+]+$/;

		if(cntctno!=="")
		{			
		
			if(!(regex.test(cntctno)))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid Phone Number");
				$(this).focus();
			}
		
		}
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter Phone Number");
			$(this).focus();
			
		}		

});

function isDate(txtDate)
{
    var currVal = txtDate;
    if(currVal === '')
        return false;
    
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    
    if (dtArray === null) 
        return false;
    
    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[1];
    dtDay= dtArray[3];
    dtYear = dtArray[5];        
    
    if (dtMonth < 1 || dtMonth > 12) 
        return false;
    else if (dtDay < 1 || dtDay> 31) 
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31) 
        return false;
    else if (dtMonth == 2) 
    {
        var isleap = (dtYear % 4 === 0 && (dtYear % 100 !== 0 || dtYear % 400 === 0));
        if (dtDay> 29 || (dtDay === 29 && !isleap)) 
                return false;
    }
    return true;
}

$('#dob').change(function() 
{ 
		
		var dob=document.getElementById("dob").value;
		
		if(dob!=="")
		{			
		
			if((!(isDate(dob))))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter a valid Date of Birth ");
				$(this).focus();
			}
		
		}
		
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter your Date of Birth");
			$(this).focus();
			
		}		

});	
$('#fname').change(function() 
{ 
		
		var fname=document.getElementById("fname").value;
		
		var regex = /^[a-zA-Z()]+$/;
		
		if(fname!=="")
		{			
		
			if((!(regex.test(fname))))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid First Name");
				$(this).focus();
			}
		
		}
		
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter FirstName");
			$(this).focus();
			
		}		

});	

$('#lname').change(function() 
{ 
		
		var lname=document.getElementById("lname").value;
		
		var regex = /^[a-zA-Z()]+$/;
		
		if(lname!=="")
		{			
		
			if((!(regex.test(lname))))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid Last Name");
				$(this).focus();
			}
		
		}
		
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter Last Name");
			$(this).focus();
			
		}		

});	
$('#password').change(function() { 
		
		var password=document.getElementById("password").value;	
		var regex = /^[A-Za-z0-9 _.-]+$/;

		if(password!=="")
		{			
		
			if((!(password.length>=6)) || (!(regex.test(password))))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid Password");
				$(this).focus();
			}
		
		}
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter Password");
			$(this).focus();
			
		}		

});
$('#username').change(function() { 
		
		var email=document.getElementById("username").value;
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-_.])+)+$/;	
		
		if(email!=="")
		{
			if(!regex.test(email)) 
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid Email");
				$(this).focus();

			}
		
		}

		else
		{
			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter Email");
			$(this).focus();
		}
	
});

$('#cpassword').change(function() { 
		
		var password=document.getElementById("password").value;	
		var cpassword=document.getElementById("cpassword").value;	

		if(cpassword!=="")
		{			
		
			if((!(cpassword.length>=6)) || (!(cpassword == password)))  
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Confirm Password,Correctly");
				$(this).focus();
			}
		
		}
		else
		{

			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Confirm Password");
			$(this).focus();
			
		}		

});

});
</script>
<footer class="container-fluid text-center">
  <p>Copyright &copy;Realtor.com. All rights reserved.</p>
</footer>
</body>
</html>