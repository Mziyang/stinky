<title>Admin Login</title>
<link rel="stylesheet" href="../css/main.css">


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
<form action="admin_login.php" method="get" class="text-center">


    <p>User Name:<input name="admin" type="text" placeholder="admin"
                    value="<?php
                    if(!session_id()){ session_start();}
                    if(isset($_POST['admin'])){echo htmlentities($_POST['admin']);}
                    ?>" autofocus>
    </p>

    <p>
        Key:<input name="key" type="password" placeholder="1234" ><br>
    </p>
    <button type="submit" class="btn">Admin Login</button>
    <a href="../index.php">Back to Home</a>
</form>
