<?php
session_start();
//$username = $_POST['username'];
$operation = $_POST['operation'];
$id = $_POST['propertyid'];
$isapt = (strcmp($_POST['isapt'], "isapartment") == 0) ? 1 : 0;
$aptid = (empty($_POST['aptid'])) ? 0 : $_POST['aptid'];
$street = $_POST['street'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$sqft = $_POST['sqft'];
$bhk = $_POST['bhk'];
$bath = $_POST['bath'];
$isavailable = (strcmp($_POST['isavailable'], "isavailable") == 0) ? 1 : 0;
$isdeleted = 0;
$price = $_POST['price'];
$image = $_POST['hiddenid'].".jpg";
$query = "";


//header('Location: property_edit.html');
//exit();
//if(empty($username) || empty($password)) {
//	header('Location: login.html');
//	exit();
//}
//echo "HIiiiiiiiiiiiiiiiii ". $isapt;
//echo "<br>ksdnfkjn  ".$isavailable;
//echo "<br>OPERATION: ".$operation;
$con = mysqli_connect("localhost","root","root","realtor","8889");
if(mysqli_connect_errno()) {
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(strcmp($operation, "Add") == 0) {
	$query = "insert into realtor.property values(".$_POST['hiddenid'].",".$isapt.",".$aptid.",'".$street."','".$city."','".$state."',".$zip.",".$sqft.",".$bhk.",".$bath.",".$isavailable.",0,".$price.",'".$image."')";
	
}
else if (strcmp($operation, "Update") == 0) {
	$query = "update realtor.property
				set
					isapt = ".$isapt.", aptno = ".$aptid.",	street = '".$street."',	city = '".$city."',	state = '".$state."',zipcode = ".$zip.",sqft = ".$sqft.",
					bhk = ".$bhk.",	bath = ".$bath.",isavailable = ".$isavailable.",isdeleted = ".$isdeleted.",	price = ".$price.",	image = '".$image."' 
				where propertyid = ".$id.";";
}
else {
	$query = "update property set isdeleted = 1, isavailable = 0 where propertyid = '$id'";
}
//echo $query;
$result = mysqli_query($con,$query);
//echo "<br>";
mysqli_close($con);
if($result) {
	echo "<script language='javascript'>
		window.alert('Successful!!'); window.location.href = 'property_edit.html'; </script>";
}
else {
	
	echo "<script language='javascript'>
		window.alert('Failed!! Please enter valid values'); window.location.href = 'property_edit.html'; </script>";
}



//echo $query;
//header('Location: property_edit.html');


?>
