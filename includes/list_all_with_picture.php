<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>List Picture Vision</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- My CSS -->
    <!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="../css/style.css" rel="stylesheet">

</head>
<body>



<!-- Navigation -->
<?php require_once(dirname(__FILE__) . '/../includes/header.php'); ?>
<!-- Page Content -->
<div class="container">
    <a class="btn" href="list_all.php">Table View</a>
    <h1 class="my-4 text-center text-lg-left">Thumbnail Gallery</h1>

    <div class="row">
<!-- Elements Example -->
<!--        <div class="col-lg-3 col-md-4 col-xs-6">-->
<!--            <a href="#" class="d-block mb-4 h-100">-->
<!--                <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">-->
<!--            </a>-->
<!--        </div>-->







<?php
require_once('db.php');
$sql = "select products.*, categories.name as Cname from products inner join categories on products.category_id = categories.id ORDER BY products.id";
$result = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($result)){
    ?>
    <div class="col-lg-4 col-sm-6 portfolio-item">
        <div class="card h-100 text-center">
            <a class="" href="item_details.php?pid=<?php echo $row['id'] ?>"><img class="card-img-top" src="../images/<?php echo $row['img']; ?>"></a>
            <div class="card-body">
                <p>ID:  <?php echo $row['id'] ?></p>
                <p>Name:  <?php echo $row['name'] ?></p>
                <p>Category Name:  <?php echo $row['Cname'] ?></p>
                <p>Brand:  <?php echo $row['brand'] ?></p>
                <p>Flavor:  <?php echo $row['flavor'] ?></p>
                <p>Size:  <?php echo $row['size'] ?></p>
                <p>Description:  <?php echo $row['description'] ?></p>
                <p>Unit Price:  <?php echo $row['unit_price'] ?></p>
                <p>Expiration Date:  <?php echo $row['expiration_date'] ?></p>
                <p>Date Added:  <?php echo $row['date_added'] ?></p>
                <p>Store Price:  <?php echo $row['store_price'] ?></p>
                <p>Inventory:  <?php echo $row['inventory'] ?></p>
            </div>
        </div>
    </div>



<?php
}

mysqli_free_result($result);
mysqli_close($con);

?>
    </div>
</div>
<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/../includes/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>