<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/index.php">Stinky</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if(empty(session_id())){ session_start();} if(empty($_SESSION['login_user'])){ ?> <li class="nav-item"><a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";}?>/customer/login.php">Login</a></li> <?php } ?>

                <?php if(empty($_SESSION['login_user'])){ ?><li class="nav-item"><a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/register.php">Register</a></li>  <?php } ?>
                <li class="nav-item"><a class="nav-link" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/order.php">Orders</a></li>
                <li class="nav-item"><a class="nav-link cart" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/cart.php">Cart</a></li>
                <!-- Drop Down -->

                <?php if(empty(session_id())){ session_start();} if(empty($_SESSION['login_user'])){ ?>


                <?php }else{ ?>


                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $_SESSION['login_user']; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown01">
                            <a class="dropdown-item" href="#"><?php
                               //echo last login time
                               if(isset($_SESSION['last_login'])){echo "Last loin at: ".$_SESSION['last_login'];}
                               //end
                               ?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/profile.php">Profile</a>
                            <a class="dropdown-item" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/reset_password.php">Reset PWD</a>
                            <a class="dropdown-item" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/logout.php">Logout</a>
                        </div>
                    </li>

                <?php } ?>
            </ul>

            <?php require_once ('search_bar.php'); ?>
        </div>

    </div>
</nav>

<!-- decoration the cart show the quantity of the selected products -->
<?php
if(!session_id()){ session_start();}

if(!empty($_SESSION['login_user'])){


//get customer_id

require_once('db.php');
$user = $_SESSION['login_user'];
$sql_cid = "select * from customers WHERE email='$user'";
$result_cid=mysqli_query($con,$sql_cid);
$row = mysqli_fetch_array($result_cid);
$_SESSION['customer_id'] = $row{'id'};
$customer_id=$row{'id'};
mysqli_free_result($result_cid);
//end

//get total of selected products
//require_once ('db.php');
$sql_qty = "SELECT SUM(quantity) AS Qty, COUNT(product_id) AS Cnt from order_details WHERE order_id IS NULL AND temp_cutomer_id = $customer_id";
$result_qty = mysqli_query($con, $sql_qty);
$row_qty = mysqli_fetch_array($result_qty);
//echo $row_qty['Qty'];
//$qty = $row_qty['Qty'];
//echo $row_qty['Cnt'];
//get number of products

    if($row_qty['Qty'] !=0){
        ?>


        <style>
            .cart::after{
                content: "<?php echo " (".$row_qty['Qty'] ." in ".$row_qty['Cnt'].")"; ?>";
                color: red;
            }

        </style>


    <?php }



mysqli_free_result($result_qty);


}

?>