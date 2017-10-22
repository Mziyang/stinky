<link href="../css/main.css" rel="stylesheet" type="text/css">
<style>tr:hover{ color: deepskyblue;}</style>
<?php
require_once('../includes/db.php');
//get customer id
if(!session_id()){ session_start();}
//customer email
//echo $_SESSION['login_user'];
$c_email = $_SESSION['login_user'];
$sql = "select mytable.*, orders_status.status_name from 
(select id AS order_id, order_date, required_date, ship_address, shipped_date, freight, status_id from orders 
WHERE customer_id = (SELECT id FROM customers WHERE email = '$c_email')) mytable 
INNER JOIN orders_status ON mytable.status_id = orders_status.id ORDER BY mytable.order_date DESC";
$result = mysqli_query($con, $sql);
?>
<table>
    Order List:
    <tr>
        <th>order_id</th>
        <th>order_date</th>
        <th>required_date</th>
        <th>ship_address</th>
        <th>shipped_date</th>
        <th>freight</th>
        <!--<th>status_id</th>-->
        <th>status_name</th>
        <th></th>
    </tr>

    <?php while ($row = mysqli_fetch_array($result)){ ?>
        <tr>
        <td> <?php  echo $row['order_id']; ?> </td>
        <td> <?php  echo $row['order_date']; ?> </td>
        <td> <?php  echo $row['required_date']; ?> </td>
        <td> <?php  echo $row['ship_address']; ?> </td>
        <td> <?php  echo $row['shipped_date']; ?> </td>
        <td> <?php  echo $row['freight']; ?> </td>

        <td> <?php  echo $row['status_name']; ?> </td>
        <td><a href="order_details.php?oid=<?php  echo $row['order_id']; ?>">Details</a></td>
        </tr>
    <?php
}
?>
</table>
