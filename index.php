<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Welcome to Stinky Store Ltd.</title>
<link href="css/main.css" rel="stylesheet" type="text/css">
</head>

<body>

<!-- Main Container -->
 <div class="container nav">
     <?php require_once(dirname(__FILE__) . '/includes/header.php'); ?>

     <?php require_once(dirname(__FILE__) . '/includes/search_bar.php'); ?>
 </div>

<div class="container main">
    <div class="list text-center" >
     <!-- product list -->
     <?php
     require_once(dirname(__FILE__) . '/includes/db.php');

     mysqli_query($con,"SET NAMES 'UTF8'");

     $sql = "select * from products";
     $sql .=" WHERE inventory != 0 ORDER BY date_added DESC LIMIT 9";
     $result = mysqli_query($con, $sql);
     while($row = mysqli_fetch_array($result)){
     ?>

         <div class="col">
             <div class="thumbnail">

                 <a href="includes/item_details.php?pid=<?php echo $row['id']; ?>" class="">
                 <img src="images/<?php echo $row['img']; ?>" alt=" " class="" width="">
                 </a>
                 <div class="caption">
                     <h3><?php echo $row['name']; ?></h3>
                     <p>Price: <?php setlocale(LC_MONETARY,"en_US");echo money_format('%i',$row['unit_price']); ?></p>
                     <p><a href="includes/jump.php?msg=added_to_cart&jump=index&pid=<?php echo $row['id']; ?>" class="btn">Add to Cart</a>
                         <a href="includes/item_details.php?pid=<?php echo $row['id']; ?>" class="btn">Buy</a>
                     </p>
                 </div>
             </div>
         </div>

         <?php
     }
     ?>
    </div>
    <a href="includes/list_all.php" class="btn rhalf">Products List</a>
</div>

<?php require_once(dirname(__FILE__) .'/includes/footer.php') ?>

<?php
//echo $_SERVER['PHP_SELF'];
?>
</body>


</html>