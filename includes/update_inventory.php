<?php

//get customer_id
require_once('db.php');
if(!session_id()){ session_start();}
$user = $_SESSION['login_user'];
$sql = "select * from customers WHERE email='$user'";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$_SESSION['customer_id'] = $row{'id'};
$customer_id=$row{'id'};
mysqli_free_result($result);
//end

//update inventory
$result2 = mysqli_query($con,"select * from order_details WHERE identifier_inventory = 0 AND temp_cutomer_id = $customer_id");
while($row2 = mysqli_fetch_array($result2)){
    //echo "ID: ".$row['product_id'];

    $pid = $row2['product_id'];
   // echo "Qty: ".$row['quantity'];

    $qty = $row2['quantity'];



    //echo "<br>";
    //update inventory in products table
    $update_inventory = mysqli_query($con, "update products set inventory = inventory - $qty WHERE id = $pid");

    //get order_details id
    $od_id = $row2['id'];



    //set orders.status_id = 1 (Invoiced)
    //get order id
    $oid = $row2['order_id'];
    $update_status_id = mysqli_query($con, "update orders set status_id = 1 WHERE id = $oid");

    //set identifier_inventory = 1 to escape updating inventory many times
    $update_identifier_inventory = mysqli_query($con, "update order_details set identifier_inventory = 1 WHERE id = $od_id");
}

mysqli_free_result($result2);
//end

//fill invoices table
date_default_timezone_set('PRC');
$now = date('Y-m-d H:i:s');
$sql_insert ="insert into invoices(order_id, invoices_date) VALUES ($oid, '$now')";
$result_insert = mysqli_query($con, $sql_insert);
//end

//disconnect
mysqli_close($con);

//jump to home page
header("location:jump.php?msg=inventory&jump=index")
?>