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

<link href="../css/main.css" rel="stylesheet" type="text/css">

<form action="#" method="post" class="text-center">
    <div class="row">
    <p>Phone Number: <input type="text" name="phone_number" placeholder="Registered Phone number" value="<?php if(isset($_POST['phone_number'])){echo $_POST['phone_number'];} ?>"</p><br>
    Registered Email: <input type="text" name="email" placeholder="Registered email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>"><br>
    New Password: <input type="password" name="password" placeholder="New password" value="<?php if(isset($_POST['password'])){echo $_POST['password'];} ?>"><br>
    Confirm Your Password: <input type="password" name="re-password" placeholder="Retype your password" value="<?php if(isset($_POST['re-password'])){echo $_POST['re-password'];} ?>"><br>
    <input type="submit" name="submit" value="Update password">
    </div>
</form>

<a href="login.php">go to login page</a>



