<?php
if(isset($_POST['post_item_qty'])&&isset($_POST['cart_id'])){
    $item_qty = $_POST['post_item_qty'];
    echo $item_qty;
    $cart_id = $_POST['cart_id'];
    //update
    require_once('db.php');
    $sql = "update order_details set quantity =$item_qty WHERE id = $cart_id";

    if($result = mysqli_query($con, $sql)){header("location:../customer/cart.php");}
}