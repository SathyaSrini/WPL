<?php
session_start();
$host="localhost:8889";
$username="root";
$password="root";
$dbname="realtor";
$db = new PDO("mysql:dbname=$dbname;host=$host", $username, $password);
$user_id = $_SESSION['usr_id'];
$data = $_POST['items'];
$total_price = 0;
$dispflag = 0;
$res_row=array();

if(isset($_SESSION['usr_id']) && !empty($data))
{
	$items = json_decode(stripslashes($_POST['items']));
	foreach($items as $itm){ 
//$dispflag = 1
	$total_price += explode("$", $itm)[1]; 
	}
	$result = $db->prepare("select IFNULL(max(orderid), 0) from orders");
	$result->execute();
	$id = $result->fetchColumn();
	$id += 1;
	$result2 = $db->prepare("INSERT IGNORE INTO orders (orderid, userid, cost) VALUES (:orderid, :userid, :cost)");
	$result2->bindParam(':orderid', $id);
	$result2->bindParam(':userid', $user_id);
	$result2->bindParam(':cost', $total_price);
	//$result2 = $db->prepare("insert ignore into orders (orderid, userid, cost)values(".$id.",".$user_id.",".$total_price.")");
	$resss = $result2->execute();
	
	
foreach($items as $itm){  
  //print_r($user_id);
  $stmt = $db->prepare("INSERT IGNORE INTO orderitems (orderid, propertyid, sellingprice) VALUES (:orderid, :propertyid, :sellingprice)");
  $stmt->bindParam(':orderid', $id);
  $stmt->bindParam(':propertyid', explode("$", $itm)[0]);
  $stmt->bindParam(':sellingprice', explode("$", $itm)[1]);
  $res = $stmt->execute();
  $stmt2 = $db->prepare("update property set isavailable = 0 where propertyid = :propertyid");
  $stmt2->bindParam(':propertyid', explode("$", $itm)[0]);
  $res = $stmt2->execute();
  ///$res->lastInsertId();
  
}
$db = NULL;

}

else {
	$result=$db->prepare("SELECT property.propertyId,isApt,aptno,street,city,state,zipcode,sqft,bhk,bath,price,image,isavailable,isdeleted FROM property, wishlist WHERE wishlist.propertyid = property.propertyid and wishlist.userid = '$user_id' and wishlist.propertyid not in (select orderitems.propertyid from orderitems, orders where orders.orderid = orderitems.orderid and orders.userid = '$user_id')order by isavailable desc, isdeleted asc");
	$result->execute();
	//$result=$db->prepare($sqlQuery);
while($row=$result->fetch())
{

  $res=array("cn"=>$row['propertyId'],"a"=>$row['aptno'],"st"=>$row['street'],"c"=>$row['city'],"s"=>$row['state'],"z"=>$row['zipcode'],"sq"=>$row['sqft'],"b"=>$row['bath'],"bh"=>$row['bhk'],"i"=>$row['image'],"p"=>$row['price'],"isavai"=>$row['isavailable'],"isdele"=>$row['isdeleted']);
  $res_row[]=$res;
}

$db = NULL;
echo json_encode($res_row);
}

?>