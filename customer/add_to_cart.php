<?php





//get customer_id
require_once('login_check.php');


require_once('../includes/db.php');
$user = $_SESSION['login_user'];

$sql = "select * from customers WHERE email='$user'";


$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

$_SESSION['customer_id'] = $row{'id'};
$customer_id=$row{'id'};
mysqli_free_result($result);
//end

if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
}

//get product_price start
$sql_price = "select unit_price from products where id = $pid";
$result_price = mysqli_query($con,$sql_price);
$row_price = mysqli_fetch_array($result_price);
$price = $row_price['unit_price'];
mysqli_free_result($result_price);
//end




$sql_insert = "insert into order_details(product_id, temp_cutomer_id, unit_price, quantity) VALUES ($pid,$customer_id,$price,1)";
$result_insert = mysqli_query($con,$sql_insert);

mysqli_close($con);
?>