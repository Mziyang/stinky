<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shopping Cart</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- My CSS -->
    <!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="../css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<?php require_once(dirname(__FILE__) . '/../includes/header.php'); ?>



<?php

//1. prepare to turn back this page after login
if(!session_id()){ session_start();}

$_SESSION['web_name'] = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'];
//echo $_SESSION['web_name'];
//require_once('login_check.php');

//2. this step is in the jump page(login page)
//3. clean the $_SERVER['web_name']
//unset($_SERVER['web_name']);



require_once('login_check.php');
require_once('../includes/header.php');





//get customer_id

require_once('../includes/db.php');
$user = $_SESSION['login_user'];
$sql = "select * from customers WHERE email='$user'";
$result=mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
$_SESSION['customer_id'] = $row{'id'};
$customer_id=$row{'id'};
mysqli_free_result($result);
//end

//get product_id
if(isset($_GET['pid'])){$pid = $_GET['pid'];}
//end

//get quantity of each selected products
if(isset($_GET['pid'])&&isset($_GET['quantity'])){
    $pid = $_GET['pid'];
    $qty = $_GET['quantity'];

    //get product_price start
    $sql_price = "select unit_price from products where id = $pid";
    $result_price = mysqli_query($con,$sql_price);
    $row_price = mysqli_fetch_array($result_price);
    $price = $row_price['unit_price'];
    mysqli_free_result($result_price);
    //end
    $sql_insert = "insert into order_details(product_id, temp_cutomer_id, unit_price, quantity) VALUES ($pid,$customer_id,$price,$qty)";
//    echo $sql_insert;
    $result_insert = mysqli_query($con,$sql_insert);

    //to clean GET info and support the cart number update(cart.php page needs refreshing)
//    header('location:cart.php');

}




//$sql_cart = "select id, product_id, unit_price, quantity FROM order_details WHERE temp_cutomer_id = $customer_id AND order_id = 0";
//add the products.img
$sql_cart = "select order_details.id, order_details.product_id, order_details.unit_price, order_details.quantity, products.img FROM order_details INNER JOIN products ON order_details.product_id = products.id WHERE order_details.temp_cutomer_id = $customer_id AND order_details.order_id IS NULL";
$result_cart = mysqli_query($con,$sql_cart);


$cnt = mysqli_num_rows($result_cart);
if($cnt == 0){ echo "Cart is empty!";?> <a href="../index.php">Go back to home page</a> <?php }
else{
    $subtotal = 0;
    while($row_cart = mysqli_fetch_array($result_cart)){
        //get product_id
        $product_id = $row_cart['product_id'];
        //end

        //get max select quantity
        $sql_inventory = "select inventory from products where id=$product_id ";
        $result_inventory = mysqli_query($con, $sql_inventory);
        $row_inventory = mysqli_fetch_array($result_inventory);
        $max_select_qty = $row_inventory['inventory'];
        mysqli_free_result($result_inventory);
        //end

        //product img
        ?>
        <a href="../includes/item_details.php?pid=<?php echo $row_cart['product_id']; ?>"><img src="../images/<?php echo $row_cart['img']; ?>" width="200px"></a>
        <?php

        echo"PID:". $row_cart['product_id'];
        setlocale(LC_MONETARY,"en_US");
        echo"Price:". money_format('%i',$row_cart['unit_price']);

        echo"Qty:". $row_cart['quantity'];
        ?>



        <form action="../includes/update_cart_qty.php" method="post" style="display: inline">

            <input type="number" name="post_item_qty" value="<?php echo $row_cart['quantity'] ?>" min="1" max="<?php if ($max_select_qty < 100) {
                echo $max_select_qty;
            } else {
                echo "100";
            } ?>" required>
            <input type="number" name="cart_id"  value="<?php echo $row_cart['id'] ?>" hidden>

            <input type="submit" value="Update" class="btn btn-outline-primary">
        </form>
        <?php


        setlocale(LC_MONETARY, 'en_US');
        echo "subtotal: ".money_format('%i',$row_cart['unit_price'] * $row_cart['quantity']);
        ?>
        <a class="btn btn-outline-primary" href='../includes/deletion.php?cart_id=<?php echo $row_cart['id'] ?>'>Delete</a>

        <?php
        echo "<br>";

        $subtotal += $row_cart['unit_price'] * $row_cart['quantity'];
        //prepare total if order table has total field.
        //$_SESSION['total'] = $subtotal;
    }
    setlocale(LC_MONETARY,"en_US");
    echo "Grand Total: ".money_format('%i',$subtotal);
    ?>
    <a href="order.php?insert_order=1" class="btn btn-outline-primary">Place order</a>
    <?php
}
mysqli_free_result($result_cart);
mysqli_close($con);

//require_once('../includes/footer.php');

?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>







