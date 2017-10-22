<link href="../css/main.css" rel="stylesheet" type="text/css">
<?php
if(isset($_GET['oid'])){
    $oid = $_GET['oid'];

    require_once('../includes/db.php');

    $sql = "select order_details.order_id, order_details.product_id, order_details.unit_price, order_details.quantity, products.name 
from order_details 
INNER JOIN products ON order_details.product_id = products.id 
WHERE order_details.order_id = $oid";

    //need to add customer id(each customer can see all orders after changing $oid in url manually)
    if(!session_id()){ session_start(); }
    if(isset($_SESSION['customer_id'])){$cid = $_SESSION['customer_id'];$sql .= " AND order_details.temp_cutomer_id = $cid";}
    //echo $sql;

    $result = mysqli_query($con, $sql);
    $cnt_row = mysqli_num_rows($result);
    if($cnt_row === 0){
        echo "Please Check Your Own Order Number.";
        ?>
        <a href="order.php">Go to my order</a>
        <?php
    }
?>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
    <?php

    while ($row = mysqli_fetch_array($result)){ ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['unit_price']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><a href="../includes/item_details.php?pid=<?php echo $row['product_id']; ?>">Product Details</a></td>
        </tr>

<?php
    }

    ?>
    </table>
<?php

}


?>