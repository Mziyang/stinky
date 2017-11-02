<title>Jumping to ...</title>

<?php

if (isset($_GET['msg'])&&isset($_GET['jump'])) {

    $jump = $_GET['jump'];

    if ($_GET['msg'] == "pwd_changed") {
        ?>

        <div class="message">You changed your password successfully</div>

        <?php
    }

    if ($_GET['msg'] == "added_to_cart"){//include_once('some.php');    //$sql ="insert into "
        require_once(dirname(__FILE__) .'/../customer/add_to_cart.php');
        ?>
        <div class="message">Product added to cart successfully!</div><a href="../customer/cart.php">Check Cart</a>
<?php
    }

    if($_GET['msg'] == "inventory"){
        ?>

        <div class="message">Thanks to buy! </div>

<?php
    }

    ?>

    <script type="text/javascript">
        window.seconds = 10;
        window.onload = function()
        {
            if (window.seconds !== 0)
            {
                document.getElementById('secondsDisplay').innerHTML = '' + window.seconds + ' second' + ((window.seconds > 1) ? 's' : '');
                window.seconds--;
                setTimeout(window.onload, 1000);
            }
            else
            {
                window.location = '<?php echo $jump; ?>.php';
            }
        }
    </script>

    <p><strong>You will be redirected to the <?php echo $jump; ?>  page in <span id="secondsDisplay"style="color: deepskyblue"></span>.</strong></p>

    <p>If you are not automatically taken there, please click on the following link: <a href="<?php echo $jump; ?>.php">Go to <?php echo $jump; ?></a></p>


    <?php

}
else{
    header("location: ../index.php");
}


?>



