<?php

session_start();


$host="localhost:8889";
$username="root";
$password="root";
$dbname="realtor";
$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);

$user_id = $_SESSION['usr_id'];

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

if (!isset($_SESSION['city'])) {
    $city= $_SESSION['city'];
}
else{
    $city="";
}
unset($_SESSION['city']);


$res_row=array();

$hType=$_GET['hType'];
$beds =$_GET['beds'];
$baths =$_GET['baths'];
$city =$_GET['city'];
$state =$_GET['state'];
$city ="Dallas";

if($city=="")
{
$result=$db->prepare("SELECT propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image FROM property WHERE isavailable = 1 AND isdeleted = 0");
}
elseif($city!="")
{

   if(strcmp($city,"Any")==0)
   {
    $sqlQuery = "SELECT propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image FROM property WHERE city='$city' AND isavailable = 1 AND isdeleted = 0";
   }
   else
   {
    $sqlQuery = "SELECT propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image FROM property WHERE isavailable = 1 AND isdeleted = 0";
   }


    if($hType!=""&&$hType!=9)
    	$sqlQuery .= " AND isapt = $hType";
    if($beds!=""&&$beds!=9)
    	$sqlQuery .= " AND bhk = $beds";
    if($baths!=""&&$baths!=9)
    	$sqlQuery .= " AND bath = $baths";
    if($state!="")
    	$sqlQuery .= " AND state = $state"; 

    
    $result=$db->prepare($sqlQuery);
	
}
else
{
}



$result->execute();
while($row=$result->fetch())
{

  $res=array("cn"=>$row['propertyId'],"a"=>$row['aptno'],"st"=>$row['street'],"c"=>$row['city'],"s"=>$row['state'],"z"=>$row['zipcode'],"sq"=>$row['sqft'],"b"=>$row['bath'],"bh"=>$row['bhk'],"i"=>$row['image'],"p"=>$row['price']);
  $res_row[]=$res;
}
echo json_encode($res_row);

?>