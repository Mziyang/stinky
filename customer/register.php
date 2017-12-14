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
    <link rel="stylesheet" href="../css/bootstrap.min.css"">
    <!-- My CSS -->
    <!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="../css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<?php require_once(dirname(__FILE__) . '/../includes/header.php'); ?>


<?php
require_once('../includes/db.php');
if (isset($_POST['submit'])) {
    if (!empty($_POST['first_name'])&&
        !empty($_POST['last_name'])&&
        !empty($_POST['email'])&&
        !empty($_POST['address'])&&
        !empty($_POST['password'])&&
        !empty($_POST['re-password'])&&
        !empty($_POST['phone_number'])) {
        $escape_first_name = mysqli_escape_string($con, $_POST['first_name']);
        $escape_last_name = mysqli_escape_string($con, $_POST['last_name']);
        $escape_email = mysqli_escape_string($con, $_POST['email']);
        $escape_address = mysqli_escape_string($con, $_POST['address']);
        $escape_password = mysqli_escape_string($con, $_POST['password']);
        $escape_re_password = mysqli_escape_string($con, $_POST['re-password']);
        $escape_phone_number = mysqli_escape_string($con, $_POST['phone_number']);

        date_default_timezone_set('PRC');
        $date = date('Y-m-d H:i:s');

        $md5_password = md5($escape_password);
        $salt = "StinkyLtd.salt.noonecancallbackyestoday";
        $format = "Stinky.Format";
        $f_s = $format . $salt;
        $hash = crypt($md5_password,$f_s);
        $md5_2 =md5($hash);

        if ($escape_password == $escape_re_password) {
            if (strlen($escape_re_password) < 8) {
                echo "Password too short!(at least 8 letter)";
            }

            elseif (!preg_match("#[0-9]+#", $escape_re_password)) {
                echo  "Password must include at least one number!";
            }

            elseif (!preg_match("#[a-zA-Z]+#", $escape_re_password)) {
                echo "Password must include at least one letter!";
            }
            else{
            $sql = "insert into customers(first_name,last_name, email, address, phone_number, password,register_date,active_date) ";
            $sql .= "values ('$escape_first_name','$escape_last_name', '$escape_email', '$escape_address', '$escape_phone_number', '$md5_2', '$date', '$date')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                echo "Cannot register right now.";
            }
            if (mysqli_insert_id($con) == 0) {
                echo "Your phone# or email has been registered". "<a href='reset_password.php'>Forgot password?</a>";
            } else {
                session_start();
                $_SESSION['register_user'] = $_POST['email'];
                header("location:login.php");
            }
            }
        }
        else {
            echo "<b style='color: deeppink;'>Passwords didn't match.</b>";
        }
    } else {echo"<b style='color: red;'>Fill all in the blanks</b>";}
}
else{ ?>
    <div class="alert alert-primary text-center" role="alert">
        Welcome! Fill all blanks to register.
    </div>
<?php }
mysqli_close($con);
?>
<div class="container">
    <div class="row">
        <div class="card card-login mx-auto">
            <div class="card-header text-center">Register</div>

            <div class="card-body">

                <form action="register.php" method="POST">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                        <label for="fname">First Name:</label>
                        <input id="fname" class="form-control" type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" autofocus>
                        </div>

                        <div class="form-group col-md-6">
                        <label for="lname">Last Name:</label>
                        <input id="lname" class="form-control" type="text" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>">
                        </div>
                    </div>

                    <div class="form-group">
                    <label for="address">Address:</label>
                    <input id="address" class="form-control" type="text" name="address" value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>">
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                        <label for="email">E-mail:</label>
                        <input id="email" class="form-control" type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                        </div>

                        <div class="form-group col-md-6">
                        <label for="phone">Phone Number:</label>
                        <input id="phone" class="form-control" type="text" name="phone_number" value="<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];} ?>">
                        </div>
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                        <label for="pwd">Password:</label>
                        <input id="pwd" class="form-control" type="password" minlength="8" maxlength="32" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>">
                        </div>

                        <div class="form-group col-md-6">
                        <label for="cpwd">Confirm Password:</label>
                        <input id="cpwd" class="form-control" type="password" minlength="8" maxlength="32" name="re-password" value="<?php if(isset($_POST['re-password'])){echo $_POST['re-password'];} ?>">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                </form>

                <div class="text-center">
                    <a class="d-block small mt-3" href="login.php" >Already on Stinky Store? Sign in</a>
                    <a class="d-block small" href="../index.php">Back to home</a>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/../includes/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
