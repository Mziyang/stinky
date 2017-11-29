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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!-- My CSS -->
    <!--    <link href="css/main.css" rel="stylesheet" type="text/css">-->
    <link href="../css/style.css" rel="stylesheet">

</head>
<body>

<!-- Navigation -->
<?php require_once(dirname(__FILE__) . '/../includes/header.php'); ?>


<?php
require('../includes/db.php');
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
else echo "Welcome! Fill all blanks to register.";
mysqli_close($con);
?>
<form action="register.php" method="POST">
    <label style="background-color: chartreuse;"> First Name:</label><input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])){echo $_POST['first_name'];} ?>" autofocus><br>
    <label style="background-color: chartreuse;">Last Name:</label><input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])){echo $_POST['last_name'];} ?>"><br>
    <label style="background-color: chartreuse;">Address:</label><input  type="text" name="address" value="<?php if(isset($_POST['address'])){echo $_POST['address'];} ?>"><br/>
    <label>E-mail:</label><input style="background-color: deepskyblue;" type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"><br/>
    <label>Phone Number:</label><input style="background-color: deepskyblue;" type="text" name="phone_number" value="<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];} ?>"><br>
    <label>Password:</label><input type="password" minlength="8" maxlength="32" name="password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"><br>
    <label>Confirm Password:</label><input type="password" minlength="8" maxlength="32" name="re-password" value="<?php if(isset($_POST['re-password'])){echo $_POST['re-password'];} ?>"><br>
    <input type="submit" name="submit" value="Sign Up">
</form>
Already on Stinky Store?<a href = "login.php">Sign in</a><br>
<a href="../index.php">Back to home</a>



<!-- Footer -->
<?php require_once(dirname(__FILE__) .'/../includes/footer.php') ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>


</body>
</html>
