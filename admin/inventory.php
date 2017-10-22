<link href="../css/main.css" rel="stylesheet" type="text/css">
<?php
require_once('login_check_admin.php');
require_once('../includes/db.php');
$sql = "select id, name, brand, size, inventory from products";
if(isset($_GET['sort'])){
    $sort = $_GET['sort'];
    $sql .=" order by $sort";
}

$result = mysqli_query($con, $sql);
?>
<table>
    <tr>
        <th><a href="?sort=id">id</a></th>
        <th><a href="?sort=name">name</th>
        <th><a href="?sort=brand">brand</th>
        <th><a href="?sort=size">size</th>
        <th><a href="?sort=inventory">inventory</th>
    </tr>
<?php
while ($row = mysqli_fetch_array($result)){ ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['brand']; ?></td>
        <td><?php echo $row['size']; ?></td>
        <td class="<?php if($row['inventory'] <=100){echo "color-red";} ?>"><?php echo $row['inventory']; ?></td>
    </tr>
    <?php
}
?>
</table>
<?php
mysqli_free_result($result);
mysqli_close($con);


?>