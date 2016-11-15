<?php
session_start();
$usr = $_SESSION['usr_id'];
if(isset($_SESSION['usr_id'])) {
	header("Location: home.html");
	exit();
}

include_once 'dbconnect.php';

if (isset($_POST['login'])) {

	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	$result = mysqli_query($con, "SELECT username,password FROM login WHERE username = '" .$username. "' and password = '" . md5($password) . "'");

	if ($row = mysqli_fetch_array($result)) 
	{
		$email = $row['username'];
		$parts = explode("@",$email);
		$uid = $parts[0];
		$_SESSION['usr_id'] = $email;
		$_SESSION['usr_name'] = $uid;
		header("Location: home.html");
	} else 
	{
		$errormsg = "Incorrect Email or Password!!!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Script</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>
					
					<div class="form-group">
						<label for="name">username</label>
						<input type="text" name="username" id = "username" placeholder="Your Email" required class="form-control" />
					</div>

					<div class="form-group">
						<label for="name">password</label>
						<input type="password" name="password" id = "password" placeholder="Your Password" required class="form-control" />
					</div>

					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		New User? <a href="register.php">Sign Up Here</a>
		</div>
	</div>
</div>

<script src="scripts/jquery-1.10.2.js"></script>
<script src="scripts/bootstrap.min.js"></script>
<script type="text/javascript">
var somethingChanged = false;
$(document).ready(function() 
{	
$('#password').change(function() { 
		
		var password=document.getElementById("password").value;	
		var regex = /^[A-Za-z0-9 _.-]+$/;

		if(password!="")
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
		if(email!="")
		{
			if(!regex.test(email)) 
			{				
				$(this).css('border-color', 'red');
				$(this).attr("placeholder", "Please Enter Valid Username");
				$(this).focus();

			}
		
		}

		else
		{
			$(this).css('border-color', 'blue');
			$(this).attr("placeholder", "Please Enter Username");
			$(this).focus();
		}
	
});   
});
</script>
</body>
</html>
