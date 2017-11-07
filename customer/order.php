<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>


<?php
require_once('../includes/header.php');

//1. prepare to turn back this page after login
if(!session_id()){ session_start();}
$_SESSION['web_name'] = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];

require_once('login_check.php');

//2. this step is in the jump page(login page)
//3. clean the $_SERVER['web_name']
unset($_SERVER['web_name']);

require_once('../includes/db.php');



if(isset($_GET['insert_order'])){
    if($_GET['insert_order'] == 1){
        //echo "Customer_ID:".$_SESSION['customer_id'];

        $cid = $_SESSION['customer_id'];

        //order date
        date_default_timezone_set('PRC');
        $order_date = date('Y-m-d H:i:s');

        //store order date
        if(!session_id()){ session_start();}
        $_SESSION['od'] = $order_date;
        //end


        $sql = "INSERT INTO orders(customer_id, order_date) VALUES ($cid,'$order_date')";
        $result = mysqli_query($con, $sql);
//echo $sql;
//echo "insert id is : ".mysqli_insert_id($con);



//prepare order id to complete the order details table
        $oid = mysqli_insert_id($con);

        //store order id
        if(!session_id()){ session_start();}
        $_SESSION['oid'] = $oid;
        //end

        $sql_update = "update order_details set order_id = $oid WHERE order_id IS NULL AND temp_cutomer_id = $cid";
//echo $sql;

        $result_update = mysqli_query($con, $sql_update);

        //clean url by loading new page
        header("location: order.php");

    }
}



?>


<?php
//sql should be added the customer id to identify
//echo $_SESSION['customer_id'];

$cid = $_SESSION['customer_id'];

$sql_order ="select * from orders WHERE status_id =(SELECT id FROM orders_status WHERE status_name = 'New') AND customer_id = $cid";

$result_order = mysqli_query($con,$sql_order);
$cnt = mysqli_num_rows($result_order);
if($cnt == 0){
    echo "No recent order.";
    ?>
    <a href='../index.php' class="btn">Go Shopping</a>
    <a href="past_order.php" class="btn">View Past Order(s)</a>

<?php


}
else{
?>
    <table>
        <tr>
            <th>Id</th>
            <th>Order Date</th>
            <th>Required Date</th>
            <th>Ship Address</th>
            <th>Freight</th>
            <th>Action</th>
        </tr>

    <?php

    while($row_order = mysqli_fetch_array($result_order) ){ ?>
        <tr>
            <td> <?php echo  $row_order['id']; ?> </td>
            <td> <?php echo  $row_order['order_date']; ?> </td>
            <td> <?php echo  $row_order['required_date']; ?> </td>
            <td> <?php echo  $row_order['ship_address']; ?> </td>
            <td> <?php echo  $row_order['freight']; ?> </td>
            <td><a href="../includes/deletion.php?restore_id=<?php echo $row_order['id']; ?>" class=""> Restore </a></td>
        </tr>
        <!--
        echo "Id: " . $row_order['id'];
        echo "customer_id: " . $row_order['customer_id'];
        echo "order_date: " . $row_order['order_date'];
        echo "required_date: " . $row_order['required_date'];
        echo "ship_address: " . $row_order['ship_address'];
        //echo "shipped_date: " . $row_order['shipped_date'];
        echo "freight: " . $row_order['freight'];
        echo "<br>";
        ?>
        -->
<?php
    }
    ?>
    </table>
    <?php


//complete order info
if(isset($_GET['complete_order'])){
    if(isset($_GET['update_required_date'])&&isset($_GET['update_ship_address'])){
        $update_required_date = $_GET['update_required_date'];
        $update_ship_address = $_GET['update_ship_address'];
        //add where clause customer id, order id, or order date
        //get customer_id
        if(!session_id()){ session_start();}
     //   //customer email
     //   $c_email = $_SESSION['login_user'];
     //   $result_customer_id = mysqli_query($con,"select id from customers WHERE email = '$c_email'");
     //   $row_customer_id = mysqli_fetch_array($result_customer_id);
     //   //echo "CID: ".$row_customer_id['id'];
     //   $cid_new = $row_customer_id['id'];
     //   //end
        $cid_new = $_SESSION['customer_id'];
            //get order id
            if(!session_id()){ session_start();}
            $oid_again = $_SESSION['oid'];
            //end
            //get order time
        if(!session_id()){ session_start();}
        $od = $_SESSION['od'];
            //end

        $sql_complete = "update orders set required_date = '$update_required_date', ship_address = '$update_ship_address' WHERE customer_id = $cid_new AND id = $oid_again AND order_date = '$od'";
//        echo $sql_complete;
        $result_complete = mysqli_query($con, $sql_complete);
        //echo $sql_complete;

        //'clean' url
        header("location: order.php");
    }
}

?>

    <form action="order.php" method="get">
        <input type="" name="update_required_date" placeholder="Required Date"
           value="<?php date_default_timezone_set('PRC'); echo date('Y-m-d H:i:s',strtotime("+3 days")); ?>" required autofocus>
        <input type="text" name="update_ship_address" placeholder="Ship Address" required>
        <input type="submit" name="complete_order" value="Update Latest Order" class="btn">
    </form>
    <a href="../index.php" class="btn">Need More Order? Go to Shopping New Order</a>
    <a href='../includes/update_inventory.php' class="btn">Confirm All Orders</a>
    <p>Note: You Cannot update again if you leave this page and place new order.Please make sure recent one is true. If you want to change again, please restore that and select again.</p>

<?php

}
mysqli_free_result($result_order);

//View the invoiced order
$sql_order_invoiced ="select * from orders WHERE status_id =(SELECT id FROM orders_status WHERE status_name = 'Invoiced') AND customer_id = $cid";

$result_order_invoiced = mysqli_query($con,$sql_order_invoiced);
$cnt_invoiced = mysqli_num_rows($result_order_invoiced);
if($cnt_invoiced == 0){
    echo "No invoiced order.";
    ?>

    <?php
}
else{?>



<table>
    <tr>
        <th>Id</th>
        <th>Order Date</th>
        <th>Required Date</th>
        <th>Ship Address</th>
        <th>Freight</th>
        <th>Action</th>
    </tr>

    <?php

    while($row_order_invoiced = mysqli_fetch_array($result_order_invoiced) ){ ?>
        <tr>
            <td> <?php echo  $row_order_invoiced['id']; ?> </td>
            <td> <?php echo  $row_order_invoiced['order_date']; ?> </td>
            <td> <?php echo  $row_order_invoiced['required_date']; ?> </td>
            <td> <?php echo  $row_order_invoiced['ship_address']; ?> </td>
            <td> <?php echo  $row_order_invoiced['freight']; ?> </td>
            <td><a href="order_details.php?oid=<?php echo $row_order_invoiced['id']; ?>" class="">Details</a></td>
        </tr>
<?php
}
?>
</table>

    <?php


}?>

<?php
mysqli_free_result($result_order_invoiced);

mysqli_close($con);

?>

<!-- Footer -->
<?php //require_once(dirname(__FILE__) .'/../includes/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>