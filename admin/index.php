<?php
if(!session_id()){session_start();}
if(isset($_SESSION['admin'])){
    if($_SESSION['admin']== "admin"){
        ?>
        <ul>
            <li><a href="sale_reports.php">Sold Monthly</a></li>
            <li><a href="inventory.php">View Store Inventory</a></li>
            <li><a href="add_product.php">Add New Products</a></li>
            <li><a href="../customer/logout.php">Logout</a> </li>
        </ul>
<?php
    }
}
else{
    header("location: admin_login.php");
}
?>




