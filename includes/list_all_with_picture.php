<link rel="stylesheet" href="../css/main.css">
<style>tr:hover{ color: deepskyblue;}</style>
<a class="btn" href="list_all.php" style="position: fixed; ">Table View</a>



<style>
    .one_row{
        padding-left: 1%;
        padding-right: 1%;
        padding-bottom: 10px;

        width: 350px;
        float: left;
        display: block;
        min-height: 350px;
    }

    .img{
        width: 60%;
        display: inline;
    }
    .desc{
        width: 40%;
        display: inline;
        float: right;
    }
    span{
        display: block;
    }
</style>










<?php
require_once('db.php');



$sql = "select products.*, categories.name as Cname from products inner join categories on products.category_id = categories.id ORDER BY products.id";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)){
    ?>
    <div class="one_row">
        <div class="img">
            <a href="item_details.php?pid=<?php echo $row['id'] ?>"><img src="../images/<?php echo $row['img']; ?>" width="60%"></a>
        </div>

        <div class="desc">
            <span>Id:  <?php echo $row['id'] ?></span>
            <span>Name:  <?php echo $row['name'] ?></span>
            <span>Category Name:  <?php echo $row['Cname'] ?></span>
            <span>Brand:  <?php echo $row['brand'] ?></span>
            <span>Flavor:  <?php echo $row['flavor'] ?></span>
            <span>Size:  <?php echo $row['size'] ?></span>
            <span>Description:  <?php echo $row['description'] ?></span>
            <span>Unit Price:  <?php echo $row['unit_price'] ?></span>
            <span>Expiration Date:  <?php echo $row['expiration_date'] ?></span>
            <span>Date Added:  <?php echo $row['date_added'] ?></span>
            <span>Store Price:  <?php echo $row['store_price'] ?></span>
            <span>Inventory:  <?php echo $row['inventory'] ?></span>
        </div>
    </div>



<?php
}

mysqli_free_result($result);
mysqli_close($con);

?>
