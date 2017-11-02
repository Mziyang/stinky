<?php
if(!session_id()){ session_start();}
if(!isset($_SESSION['login_user'])){
    if(dirname($_SERVER['PHP_SELF'])!=="/includes"){ $add = "../customer/";
    header('location:'. $add .'login.php');
    }
    else{
        header('location:login.php');
    }

}




?>
