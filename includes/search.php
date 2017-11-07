<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link href="../css/style.css" rel="stylesheet">
</head>
<body>


<?php require_once(dirname(__FILE__) . '/header.php'); ?>


<?php


require_once('db.php');

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
        ?> <div class="row"> <?php
        while($row = mysqli_fetch_array($result)){
         ?>
            <div class="col-lg-4 col-sm-6 portfolio-item">
                <div class="card h-100 text-center">

                    <a href="item_details.php?pid=<?php echo $row['id']; ?>" class="">
                        <img src="../images/<?php echo $row['img']; ?>" alt=" " class="">
                    </a>

                    <div class="card-body">
                        <h3><?php echo $row['name']; ?></h3>
                        <p>Price: <?php echo $row['unit_price']; ?></p>
                        <p><a href="jump.php?msg=added_to_cart&jump=index&pid=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Add to Cart</a>
                            <a href="item_details.php?pid=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Buy</a>
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


<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>