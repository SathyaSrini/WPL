<?php

session_start();


$host="localhost:8889";
$username="root";
$password="root";
$dbname="realtor";
$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);

$user_id = $_SESSION['usr_id'];
//echo json_encode($user_id);

/*if(isset($_SESSION['usr_id']))
{

$stmt = $db->prepare("SELECT isadmin FROM userinfo WHERE userid = (:userid)");
$stmt->bindParam(':userid', $user_id);
$stmt->execute();
while($row=$stmt->fetch())
{
    $isadmin = $row['isadmin'];
    $_SESSION['isadmin'] = $isadmin;
}

}*/
$property_id = $_POST['clicked_id'];
//print_r($property_id); 
if(isset($_SESSION['usr_id']) && !empty($property_id))
{ 
  //print_r($user_id);
  $stmt = $db->prepare("INSERT IGNORE INTO wishlist (userid, propertyid) VALUES (:userid, :propertyid)");
  $stmt->bindParam(':userid', $user_id);
  $stmt->bindParam(':propertyid', $property_id);
  $res = $stmt->execute();
if ($res)
{
   //echo "1";
}
else
{
  //echo "0";
}

}

if (isset($_SESSION['city'])) {
    $city= $_SESSION['city'];
}
else{
    $city="";
}
//unset($_SESSION['city']);

$res_row=array();
$hType=$_GET['hType'];
$beds =$_GET['beds'];
$bath =$_GET['bath'];
$citysearch = $_GET['city'];
$state =$_GET['state'];

// SQL COMMAND USED TO SET WISHLIST ITEMS as SELECTED: 
//SELECT property.propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image,IF(wishlist.propertyid IS NULL, FALSE, TRUE) as is_present FROM property LEFT JOIN wishlist ON (property.propertyId = wishlist.propertyid AND wishlist.userid = (:user_id)) WHERE isavailable = 1 AND isdeleted = 0 ;
//
//If user is not logged in 
if(!isset($_SESSION['usr_id']))
{
	$sqlQuery = "SELECT property.propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image,IF(wishlist.propertyid IS NULL, 0, 1) as is_present FROM property LEFT JOIN wishlist ON (property.propertyId = wishlist.propertyid AND wishlist.userid = (:userid)) WHERE isavailable = 1 AND isdeleted = 0";
    if((strcmp($citysearch,"")!=0)&&(strcmp($citysearch,"Any")!=0))
	   $sqlQuery .= "  AND city = '$citysearch'";
  
    if($hType!=""&&$hType!=9)
    	$sqlQuery .= " AND isapt = $hType";
    if($beds!=""&&$beds!=9)
    	$sqlQuery .= " AND bhk = $beds";
    if($bath!=""&&$bath!=9)
    	$sqlQuery .= " AND bath = $bath";
    if($state!="")
    	$sqlQuery .= " AND state = '$state'";   	
    
    $result=$db->prepare($sqlQuery);
}

else
{
	/*
if(strcmp($city,"")==0)
{
$result=$db->prepare("SELECT propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image FROM property WHERE isavailable = 1 AND isdeleted = 0");
}*/

if(is_null($citysearch)&&$_SESSION['isadmin']==0)
{	
    $sqlQuery = "SELECT property.propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image,IF(wishlist.propertyid IS NULL, 0, 1) as is_present FROM property LEFT JOIN wishlist ON (property.propertyId = wishlist.propertyid AND wishlist.userid = (:userid)) WHERE city='$city' AND isavailable = 1 AND isdeleted = 0";
	$result=$db->prepare($sqlQuery);
}
else 
{
    $sqlQuery = "SELECT property.propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image,IF(wishlist.propertyid IS NULL, 0, 1) as is_present FROM property LEFT JOIN wishlist ON (property.propertyId = wishlist.propertyid AND wishlist.userid = (:userid)) WHERE isavailable = 1 AND isdeleted = 0";
    
	if((strcmp($citysearch,"")!=0)&&(strcmp($citysearch,"Any")!=0))
	   $sqlQuery .= "  AND city = '$citysearch'";
   
    if($hType!=""&&$hType!=9)
    	$sqlQuery .= " AND isapt = $hType";
    if($beds!=""&&$beds!=9)
    	$sqlQuery .= " AND bhk = $beds";
    if($bath!=""&&$bath!=9)
    	$sqlQuery .= " AND bath = $bath";
    if($state!="")
    	$sqlQuery .= " AND state = '$state'";   	
    
    $result=$db->prepare($sqlQuery);
}
}

//echo json_encode($sqlQuery);
$result->bindParam(':userid', $user_id);
$result->execute();
while($row=$result->fetch())
{

  $res=array("cn"=>$row['propertyId'],"a"=>$row['aptno'],"st"=>$row['street'],"c"=>$row['city'],"s"=>$row['state'],"z"=>$row['zipcode'],"sq"=>$row['sqft'],"b"=>$row['bath'],"bh"=>$row['bhk'],"i"=>$row['image'],"p"=>$row['price'],"w"=>$row['is_present']);
  $res_row[]=$res;
}

echo json_encode($res_row);

?>