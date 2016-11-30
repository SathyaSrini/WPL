<?php

session_start();

$host="localhost:8889";
$username="root";
$password="root";
$dbname="realtor";
$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);

if(isset($_SESSION['usr_id']))
{
$user_id = $_SESSION['usr_id'];

$res_row=array();

//$stmt=$db->prepare("SELECT DISTINCT property.propertyId,aptno,street,city,state,zipcode,sqft,bath,bhk,image,price FROM property,orderitems,orders WHERE orders.userid = (:userid) AND orderitems.orderid=orders.orderid AND property.isdeleted=0");

$stmt = $db->prepare("select property.propertyId,aptno,street,city,state,zipcode,sqft,bath,bhk,image,price,isdeleted FROM orders, orderitems,property WHERE orders.orderid = orderitems.orderid AND orders.userid = (:userid) AND property.propertyId = orderitems.propertyid");

//$stmt=$db->prepare("SELECT * FROM property where propertyid in (Select orderitems.propertyId from order JOIN orderitems on orderitems.orderid=orders.orderid where orders.userid = (:userid)) AND property.isdeleted =0");
                                  
$stmt->bindParam(':userid', $user_id);
$stmt->execute();

while($row=$stmt->fetch())
{
  if($row['isdeleted']==1)
  $res=array("cn"=>$row['propertyId'],"a"=>$row['aptno'],"st"=>$row['street'],"c"=>$row['city'],"s"=>$row['state'],"z"=>$row['zipcode'],"sq"=>$row['sqft'],"b"=>$row['bath'],"bh"=>$row['bhk'],"i"=>$row['image'],"p"=>$row['price'],"d"=>"Not Available anymore");
  else
  $res=array("cn"=>$row['propertyId'],"a"=>$row['aptno'],"st"=>$row['street'],"c"=>$row['city'],"s"=>$row['state'],"z"=>$row['zipcode'],"sq"=>$row['sqft'],"b"=>$row['bath'],"bh"=>$row['bhk'],"i"=>$row['image'],"p"=>$row['price'],"d"=>"");  
  
  $res_row[]=$res;
}
if(empty($res_row))
{
  //echo "Null result";
  echo json_encode($res_row);
}
else
{
echo json_encode($res_row);
}
}
else
{
  //echo "User Not Logged In";
}

?>