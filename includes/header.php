<!--done adjust the href use ..  / -->
<!-- Navigation -->
<header>

    <nav>
        <div class="nav-logo">
        <a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/index.php">Stinky</a>
        </div>

        <div class="nav-bar">
            <ul>
                <?php if(empty(session_id())){ session_start();} if(empty($_SESSION['login_user'])){ ?><li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/login.php">Login</a></li> <?php }
                else{?>
                    <li class="login_last"></li>
                    <li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/profile.php"><?php echo $_SESSION['login_user']; ?> </a></li>
                <?php
                }
                ?>

                <?php if(empty($_SESSION['login_user'])){ ?><li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/register.php">Register</a></li>  <?php } ?>
                <li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/profile.php">Profile</a></li>
                <li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/order.php">Orders</a></li>
                <li><a class="cart" href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/cart.php">Cart</a></li>
                <?php if(isset($_SESSION['login_user'])){ ?><li><a href="<?php echo dirname($_SERVER['PHP_SELF']); ?><?php if(dirname($_SERVER['PHP_SELF'])!=="/stinky"){echo "/..";} ?>/customer/logout.php">Logout</a></li> <?php } ?>
            </ul>
        </div>
    </nav>

</header>

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

    //echo last login time
    if(isset($_SESSION['last_login'])){

        ?>
        <style>
            .login_last::before{
                content: "<?php echo "Last loin at: ".$_SESSION['last_login']; ?>";
                color: white;
            }

        </style>
        <?php
    }
    //end

mysqli_free_result($result_qty);


}
//echo "new";
//echo $_SERVER['PHP_SELF'];
//echo "<br>new";
//echo dirname(__FILE__);
//echo "<br>new";
//echo dirname($_SERVER['PHP_SELF']);
?>