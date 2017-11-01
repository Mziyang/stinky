<link href="../css/main.css" rel="stylesheet" type="text/css">
<div class="container nav">
    <?php require_once('header.php'); ?>

    <?php require_once('search_bar.php'); ?>
</div>
<?php
require_once('db.php');
mysqli_query($con,"SET NAMES 'UTF8'");
if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "select * from products where id=$pid";
    $result = mysqli_query($con, $sql);
    $cnt = mysqli_num_rows($result);

    if($cnt == 1) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
            <div class="list text-center" id="drinks">
                <div class="col">
                    <div class="thumbnail"><img src="../images/<?php echo $row['img']; ?>" alt=" " class="" width="400px">
                        <div class="caption">
                            <h3> <?php echo ucwords($row['name']); ?> </h3>
                            <p>Price: <?php echo $row['unit_price']; ?></p>
                            <!--<p>Store Inventory: <?php// echo $row['inventory']; ?></p> -->

                            <?php
                            if ($row['inventory'] < 100 && $row['inventory'] > 0) {
                                echo "<p>Only " . "<b>" . $row['inventory'] . "</b> left</p>";
                            } elseif ($row['inventory'] >= 100) {
                                echo "<p>In stock</p>";
                            } else {
                                echo "<p><label style='color: red; font-weight: bold'> Out of stock</label></p>";
                            } ?>

                            <?php if (!empty($row['size'])) {
                                echo "<p>Size: " . $row['size'] . "</p>";
                            } ?>

                            <a href="../customer/cart.php?pid=<?php if ($row['inventory'] != 0) {
                                echo $row['id'];
                            } ?>&quantity=1"
                               class="btn <?php if ($row['inventory'] == 0) {
                                   echo "btn-disable";
                               } ?>">
                                Select One
                            </a>

                            <!-- option 2-->
                            <form method="get" action="../customer/cart.php">
                                <input name="pid" value="<?php echo $row['id'] ?>" hidden placeholder="">
                                Qty:
                                <input name="quantity" value="1" type="number" min="1"
                                       max="<?php if ($row['inventory'] < 100) {
                                           echo $row['inventory'];
                                       } else {
                                           echo "100";
                                       } ?>" required placeholder="">

                                <button class="btn <?php if ($row['inventory'] == 0) {
                                    echo "btn-disable";
                                } ?>" type="submit"> Add to Cart</button>
                            </form>


                            <!-- suggestions or relative products with same brand and category -->
                            <?php
                            $sql2 = "Select * from products where brand = (SELECT brand from products WHERE id = '$pid') ";
                            $sql2 .= "AND category_id = (SELECT category_id FROM products WHERE id = '$pid') ";
                            $result2 = mysqli_query($con, $sql2);
                            $cnt2 = mysqli_num_rows($result2);
                            if($cnt2 != 1){
                                echo "Suggestions:";
                            }
                            while ($cnt2 != 1 && $row2 = mysqli_fetch_array($result2)) {
                                ?>
                                <a <?php if ($row2['id'] == $pid) { ?> style="color: red; font-weight: bold"  <?php } ?>
                                        href=item_details.php?pid=<?php echo $row2['id']; ?>
                                        class="btn" <?php // if($cnt == 1) echo "hidden"; ?> >
                                    <?php echo $row2['name']; ?>
                                </a>
                                <?php
                            }
                            mysqli_free_result($result2);


                            ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php
        }
    }
    else{
        header("Location:index.php");
    }
    /* free result set */
    mysqli_free_result($result);
}

else{
   header("Location:index.php");
}

/* close connection */
mysqli_close($con);
?>



