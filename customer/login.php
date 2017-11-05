<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

</head>
<body>
<?php
require_once('../includes/db.php');
if(!empty($_POST['email'])&&!empty($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $real_phone_number = mysqli_real_escape_string($con,$email);
    $real_password = mysqli_real_escape_string($con,$password);
    $md5_password =md5($real_password);
    $salt = "StinkyLtd.salt.noonecancallbackyestoday";
    $format = "Stinky.Format";
    $f_s = $format . $salt;
    $hash = crypt($md5_password,$f_s);
    $md5_2 =md5($hash);

    $sql = "select * from customers where email ='$real_phone_number' and password = '$md5_2'";

    $result = mysqli_query($con, $sql);

    $cnt = mysqli_num_rows($result);

    if($cnt ==1){
        if(!session_id()){ session_start();}
        $_SESSION['login_user'] = $_POST['email'];
        //get active date or last login date
        $result_od = mysqli_query($con,"select active_date from customers where email = '$email'");
        $row_od = mysqli_fetch_array($result_od);
        //echo "od:".$row_od['active_date'];
        $_SESSION['last_login'] = $row_od['active_date'];

        //update active date to customers table
        date_default_timezone_set('PRC');
        $date = date('Y-m-d H:i:s');
        $sql_ad = "update customers set active_date = '$date' where email = '$email'";
        //echo $sql_ad;
        $result_ad = mysqli_query($con, $sql_ad);
        //end

        //2. go back to the original page or go to home page
        if(isset($_SESSION['web_name'])){
            $web_name = $_SESSION['web_name'];
//            echo $web_name;
            header("Location: $web_name");

        }
        else{
            header("location:../index.php");
        }

    }
    else{?>
        <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
            <div class="card-header">Warning</div>
            <div class="card-body">
                <h4 class="card-title">Error pwd or email</h4>
                <p class="card-text">Please check your email and password.</p>
            </div>
        </div>
<?php
    }

    mysqli_free_result($result);
}//else{echo"fill blacks.";}

?>


<?php

//if (isset($_GET['msg'])) {
//    if ($_GET['msg'] == "pwd_changed") {
?>
        <!-- <div class="message">You changed your password successfully</div> -->

<?php
//    }
//}

?>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="login.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" value="<?php
                                if(!session_id()){ session_start();}
                                if(isset($_POST['email'])){echo htmlentities($_POST['email']);}
                                elseif(isset($_SESSION['register_user'])){echo $_SESSION['register_user'];}//$_SESSION['register_user'] ="";
                                ?>" required autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password" minlength="8" maxlength="32" value="" required>
                            </div>
<!--                            <div class="checkbox">-->
<!--                                <label>-->
<!--                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me-->
<!--                                </label>-->
<!--                            </div>-->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>
                    </form>
                </div>
            </div>
            <a href="../admin/admin_login.php" class="btn btn-outline-secondary">Admin?</a>

            <a href="reset_password.php" class="btn btn-outline-warning">Forget Password?</a>

            <a href="register.php" class="btn btn-outline-success">Join Us</a>

        </div>
    </div>

</div>





<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

</body>
</html>