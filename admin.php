<?php
$id = $_GET['id'];
$operation = $_GET['operation'];

$con = mysqli_connect("localhost","root","root","realtor","8889");
if(mysqli_connect_errno()) {
	echo "Error: Failed to connect to MySQL: " . mysqli_connect_error();
}

if(strcmp($operation, "popid") === 0) {
	//echo "OPeration is been passed";
	$query = "SELECT max(propertyid) id FROM realtor.property";
}
else {
	//echo "ID has been passed";
	$query = "SELECT * FROM realtor.property where propertyid = '$id'";
}
$result = mysqli_query($con,$query);

if($result->num_rows == 0) 
{
	echo "Error: No records available for the given ID";
}
else {
		$row = mysqli_fetch_array($result);
		if(strcmp($operation, "popid") === 0) {
			echo $row['id']+1;
		}
		else {
			echo json_encode($row);
		}
		//echo var_dump(mysqli_fetch_array($result));
		//echo "Yesss";
}

mysqli_close($con);

?>
