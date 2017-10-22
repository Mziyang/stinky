<title>Login</title>
<head><link rel="stylesheet" href="../css/main.css"></head>
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
    else{
        echo "Error pwd or email";
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
    <div class="row text-center">
        <form action="login.php" method="post" class="text-center">


            <p>email:<input name="email" type="email" placeholder="your email address"
                 value="<?php
                 if(!session_id()){ session_start();}
                 if(isset($_POST['email'])){echo htmlentities($_POST['email']);}
                 elseif(isset($_SESSION['register_user'])){echo $_SESSION['register_user'];}//$_SESSION['register_user'] ="";
                 ?>" autofocus><br>
            </p>

            <p>
                password:<input name="password" type="password" minlength="8" maxlength="32" placeholder="********" ><br>
            </p>
            <button type="submit" class="btn">login</button>
            <a href="../admin/admin_login.php" class="btn">Admin?</a>
        </form>

        <a href="reset_password.php">Forget Password?</a>

        <a href="register.php">Join Us</a>
    </div>

</div>