<link rel="stylesheet" href="../css/main.css">
<style>tr:hover{ color: deepskyblue;}</style>
<a class="btn" href="list_all_with_picture.php" style="position: fixed; ">Picture View</a>
<table>
    <tr>
        <td>Id</td>
        <td>Name</td>
        <td>Category Name</td>
        <td>Brand</td>
<!--        <td>category_id</td>-->
        <td>Flavor</td>
        <td>Size</td>
        <td>Description</td>
        <td>Unit Price</td>
        <td>Expiration Date</td>
        <td>Date Added</td>
        <td>Store Price</td>
        <td>Inventory</td>
        <td>Action</td>
    </tr>

<?php
require_once('db.php');

mysqli_query($con,"SET NAMES 'UTF8'");

$sql = "select products.*, categories.name as Cname from products inner join categories on products.category_id = categories.id ORDER BY products.id";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)){
    ?>

    <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php echo $row['Cname'] ?></td>
        <td><?php echo $row['brand'] ?></td>
<!--        <td>--><?php //echo $row['category_id'] ?><!--</td>-->
        <td><?php echo $row['flavor'] ?></td>
        <td><?php echo $row['size'] ?></td>
        <td><?php echo $row['description'] ?></td>
        <td><?php echo $row['unit_price'] ?></td>
        <td><?php echo $row['expiration_date'] ?></td>
        <td><?php echo $row['date_added'] ?></td>
        <td><?php echo $row['store_price'] ?></td>
        <td><?php echo $row['inventory'] ?></td>
        <td><a href="item_details.php?pid=<?php echo $row['id'] ?>">Select</a></td>
    </tr>

<?php
   // echo "Id: " . $row['id'];
   // echo "Name: " . $row['name'];
   // echo "Brand: " . $row['brand'];
   // echo "Category id: " . $row['category_id'];
   // echo "Flavor: " . $row['flavor'];
   // echo "Size: " . $row['size'];
   // echo "Description: " . $row['description'];
   // echo "Unit price: " . $row['unit_price'];
   // echo "Expiration date: " . $row['expiration_date'];
   // echo "Date added: " . $row['date_added'];
   // echo "Store price: " . $row['store_price'];
   // echo "Inventory: " . $row['inventory'];
   // echo "<br>";
}

mysqli_free_result($result);
mysqli_close($con);

?>
</table>
