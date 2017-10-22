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
    } else {echo"<b style='color: red;>Fill all in the blanks</b>";}
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

