<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Customer CSS -->

</head>
<body>




<?php
require_once('../includes/db.php');

if(isset($_GET['admin'])&&isset($_GET['key'])){
    $admin = $_GET['admin'];
    $key = $_GET['key'];

$sql="select * from employee WHERE login_user = '$admin' AND active_key = '$key'";
$result = mysqli_query($con,$sql);
$cnt = mysqli_num_rows($result);
if($cnt == 1){
    if(!session_id()){session_start();}
    $_SESSION['admin'] = "admin";

    header("Location: index.php");
}

}

?>


<div class="container">
    <div class="row">
        <div class="card card-login mx-auto mt-5">
            <div class="card-header text-center">Admin Login</div>
            <div class="card-body">

                <form action="admin_login.php" method="get">

                    <div class="form-group">
                        <label for="admin">User Name:</label>
                        <input id="admin" class="form-control" name="admin" type="text" placeholder="admin"
                               value="<?php
                               if(!session_id()){ session_start();}
                               if(isset($_POST['admin'])){echo htmlentities($_POST['admin']);}
                               ?>" autofocus>
                    </div>


                    <div class="form-group">
                        <label for="key">Key:</label>
                        <input id="key" class="form-control" name="key" type="password" placeholder="1234" ><br>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Admin Login</button>
                </form>

                <div class="text-center">
                    <a class="d-block small mt-3" href="../index.php" >Back to Home</a>
                </div>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>