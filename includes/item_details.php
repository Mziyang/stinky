<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product Details</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- My CSS -->
    <!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="../css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
    <?php require_once('header.php'); ?>



<?php
require_once('db.php');
if(isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $sql = "select * from products where id=$pid";
    $result = mysqli_query($con, $sql);
    $cnt = mysqli_num_rows($result);

    if($cnt == 1) {
        while ($row = mysqli_fetch_array($result)) {
            ?>
<div class="container">



    <!-- Portfolio Item Row -->
<div class="row">
    <div class="col">
        <img src="../images/<?php echo $row['img']; ?>" alt=" " class="img-fluid" width="">
    </div>
    <div class="col">
                            <h3> <?php echo ucwords($row['name']); ?> </h3>
                            <p>Price: <?php setlocale(LC_MONETARY,"en_US");echo money_format('%i',$row['unit_price']); ?></p>
                            <!--<p>Store Inventory: <?php// echo $row['inventory']; ?></p> -->

                            <?php
                            if ($row['inventory'] < 100 && $row['inventory'] > 0) {
                                echo "<p class=\"text-warning\">Only " . "<b>" . $row['inventory'] . "</b> left</p>";
                            } elseif ($row['inventory'] >= 100) {
                                echo "<p>In Stock</p>";
                            } else {
                                echo "<p class=\"text-danger\"><b>Out of Stock</b></p>";
                            } ?>

                            <?php if (!empty($row['size'])) {
                                echo "<p>Size: " . $row['size'] . "</p>";
                            } ?>
        <?php if (!empty($row['description'])) {
            echo "<p>Description: " . $row['description'] . "</p>";
        } ?>

        <?php if ($row['inventory'] != 0) {?>
            <a href="../customer/cart.php?pid=<?php echo $row['id']; ?>&quantity=1"
               class="btn btn-outline-primary">Select One</a>

            <!-- Option 2-->

            <form method="get" action="../customer/cart.php">
                <input name="pid" value="<?php echo $row['id'] ?>" hidden placeholder="">
                Qty:
                <input name="quantity" value="1" type="number" min="1"
                       max="<?php if ($row['inventory'] < 100) {
                           echo $row['inventory'];
                       } else {
                           echo "100";
                       } ?>" required placeholder="" <?php if ($row['inventory'] == 0) {
                    echo "hidden";
                } ?>>

                <button class="btn" <?php if ($row['inventory'] == 0) {
                    echo "disabled";
                } ?> type="submit"> Add to Cart</button>
            </form>
            <?php
        } ?>
    </div>
</div><!-- /.row -->

    <!-- Related Projects Row -->
    <!-- suggestions or relative products with same brand and category -->
    <?php
    $sql2 = "Select * from products where brand = (SELECT brand from products WHERE id = '$pid') ";
    $sql2 .= "AND category_id = (SELECT category_id FROM products WHERE id = '$pid') ";
    $result2 = mysqli_query($con, $sql2);
    $cnt2 = mysqli_num_rows($result2);
    if($cnt2 != 1){?>

    <h3 class="my-4">Related Projects</h3>

    <div class="row">
        <?php
    }
    while ($cnt2 != 1 && $row2 = mysqli_fetch_array($result2)) {
        ?>
        <div class="col">
        <a <?php if ($row2['id'] == $pid) { ?> style="color: red; font-weight: bold"  <?php } ?>
                href=item_details.php?pid=<?php echo $row2['id']; ?>
                class="btn" <?php // if($cnt == 1) echo "hidden"; ?> >
            <?php echo $row2['name']; ?>
        </a>
        </div>
        <?php
    }
    mysqli_free_result($result2);


    ?>



</div>
</div>
            <?php
        }
    }
    else{
        header("Location:../index.php");
    }
    /* free result set */
    mysqli_free_result($result);
}

else{
   header("Location:../index.php");
}

/* close connection */
mysqli_close($con);
?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


</body>

</html>