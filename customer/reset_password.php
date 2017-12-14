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
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Customer CSS -->
<!--    <link href="../css/main.css" rel="stylesheet" type="text/css">-->
</head>
<body>

<?php
require('../includes/db.php');
if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['re-password']) &&
        !empty($_POST['phone_number'])) {
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $password = $_POST['password'];
        $re_password = $_POST['re-password'];
        $md5_pwd = md5($password);
        $salt = "StinkyLtd.salt.noonecancallbackyestoday";
        $format = "Stinky.Format";
        $f_s = $format . $salt;
        $hash = crypt($md5_pwd,$f_s);
        $md5_2 =md5($hash);
        if ($password == $re_password) {
            echo "Password matched.";
            if (strlen($password) < 8) {
                 echo "Password too short!(at least 8 letter)";
            }

            elseif (!preg_match("#[0-9]+#", $password)) {
                echo  "Password must include at least one number!";
            }

            elseif (!preg_match("#[a-zA-Z]+#", $password)) {
                echo "Password must include at least one letter!";
            }
            else{
                $select = mysqli_query($con,"select * from customers WHERE email='$email' AND phone_number='$phone_number'");
                $rows = mysqli_num_rows($select);
                if ($rows == 1) {
                    $update = mysqli_query($con,"update customers set password = '$md5_2' WHERE email = '$email'");

                    header('location:../includes/jump.php?msg=pwd_changed&jump=login');
                }
                else{
                    echo "The phone number and email didn't match.";
                }
            }





        }
        else {echo "Password didn't match.";}
    }
    else {echo "Please Fill All Blanks.";}
}
else{
    echo"You can change your password with your registered phone number and email. If it does't work, <a style='color: aqua;' href='contact_us.php'>contact</a> any staffs to ask new password.";
}




?>


<div class="container">
    <div class="row">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header text-center">Please </div>

            <div class="card-body">

                <form action="#" method="post" class="text-center">

                        <div class="form-group">
                        <label for="phone_no">Phone Number:</label>
                        <input id="phone_no" type="text" name="phone_number" placeholder="Registered Phone number" value="<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];} ?>">
                        </div>

                        <div class="form-group">
                        <label for="email">Registered Email</label>
                        <input id="email" type="text" name="email" placeholder="Registered email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
                        </div>

                        <div class="form-group">
                        <label for="pwd">New Password:</label>
                        <input id="pwd" type="password" name="password" placeholder="New password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"><br>
                        </div>

                        <div class="form-group">
                        <label for="2pwd">Confirm Your Password:</label>
                        <input id="2pwd" type="password" name="re-password" placeholder="Retype your password" value="<?php if(isset($_POST['re-password'])){echo $_POST['re-password'];} ?>"><br>
                        </div>

                        <div class="form-group">
                        <input type="submit" name="submit" value="Update password">
                        </div>
                </form>

                <div class="text-center">
                    <a class="d-block small mt-3" href="login.php" >Go to login page</a>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>