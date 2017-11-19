<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to Stinky Store Ltd!</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- My CSS -->
<!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<?php require_once(dirname(__FILE__) . '/includes/header.php'); ?>



<!-- Page Content -->


<!-- Page Heading -->
<div class="container">






    <!-- product list -->
    <div class="row">

     <?php
     require_once(dirname(__FILE__) . '/includes/db.php');

     mysqli_query($con,"SET NAMES 'UTF8'");

     $sql = "select * from products";
     $sql .=" WHERE inventory != 0 ORDER BY date_added DESC LIMIT 9";
     $result = mysqli_query($con, $sql);
     while($row = mysqli_fetch_array($result)){
     ?>

         <div class="col-lg-4 col-sm-6 portfolio-item">
             <div class="card h-100 text-center">

                 <a href="includes/item_details.php?pid=<?php echo $row['id']; ?>" class="">
                 <img class="card-img-top" src="images/<?php echo $row['img']; ?>" alt=""  width="">
                 </a>
                 <div class="card-body">
                     <h3 class="card-title"><?php echo $row['name']; ?></h3>
                     <p>Price: <?php setlocale(LC_MONETARY,"en_US");echo money_format('%i',$row['unit_price']); ?></p>
                     <p><a href="includes/jump.php?msg=added_to_cart&jump=index&pid=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Add to Cart</a>
                         <a href="includes/item_details.php?pid=<?php echo $row['id']; ?>" class="btn btn-outline-primary">Buy</a>
                     </p>
                 </div>
             </div>
         </div>

         <?php
     }
     ?>
    </div>
    <!-- /.row -->


    <a href="includes/list_all.php" class="btn btn-outline-primary">Products List</a>

</div>
<!-- /.container -->

<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/includes/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>

</body>
</html>