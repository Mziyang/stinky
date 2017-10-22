<?php
require_once('db.php');
if(isset($_GET['cart_id'])){
    $id = $_GET['cart_id'];
    $result = mysqli_query($con,"delete from order_details where id = $id");
    header("Location: ../customer/cart.php");
}
elseif(isset($_GET['category_id'])){
    $id = $_GET['category_id'];
    $result = mysqli_query($con,"delete from categories where id = $id");
    header("Location: ../admin/add_sub_category.php");
}
elseif (isset($_GET['restore_id'])){
    $id = $_GET['restore_id'];

    //delete order
    $result = mysqli_query($con, "delete from orders where id = $id");

    //delete order details
    $result2 = mysqli_query($con, "delete from order_details WHERE order_id = $id");

    header("Location: ../customer/order.php");


}
else{
    echo "nothing can I do";
}

mysqli_close($con);

?>