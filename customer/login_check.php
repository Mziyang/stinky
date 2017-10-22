<?php
if(!session_id()){ session_start();}
if(!isset($_SESSION['login_user'])){
    header('location:login.php');
}




?>
