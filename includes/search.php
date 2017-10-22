<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="../css/main.css" rel="stylesheet" type="text/css">
</head>
<body>


<div class="container nav">
    <?php require_once('header.php'); ?>

    <?php require_once('search_bar.php'); ?>
</div>

<?php


require_once('db.php');

mysqli_query($con,"SET NAMES 'UTF8'");

if(!empty($_GET['keyword'])) {

    $search_text = $_GET['keyword'];
    $real_search_text = mysqli_real_escape_string($con,$search_text);
    $sql = "select * from products where name like '%$real_search_text%'";


    $result = mysqli_query($con, $sql);
    $cnt =mysqli_num_rows($result);
    if ($cnt == 0) {
        ?>
        <div class="search-bar-left-blank">
            Nothing Found!
            <script>alert("Nothing Found!")</script>
        </div>

        <?php
    }
    else{
        ?> <div class="list text-center"> <?php
        while($row = mysqli_fetch_array($result)){
         ?>

            <div class="col">
                <div class="thumbnail">

                    <a href="item_details.php?pid=<?php echo $row['id']; ?>" class="">
                        <img src="images/<?php echo $row['img']; ?>" alt=" " class="">
                    </a>

                    <div class="caption">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>Price: <?php echo $row['unit_price']; ?></p>
                        <p><a href="jump.php?msg=added_to_cart&jump=index&pid=<?php echo $row['id']; ?>" class="btn">Add to Cart</a>
                            <a href="item_details.php?pid=<?php echo $row['id']; ?>" class="btn">Buy</a>
                        </p>
                    </div>
                </div>
            </div>

            <?php
        }
        mysqli_free_result($result);

        ?> </div> <?php
    }
}
mysqli_close($con);
?>



</body>
</html>