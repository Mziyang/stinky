<?php
require_once('login_check_admin.php');
require_once('../includes/db.php');
date_default_timezone_set('PRC');
if(isset($_GET['time_start'])&&isset($_GET['time_end'])){
    $last_month = $_GET['time_start'];
    $date_now = $_GET['time_end'];


}else{
    $last_month = date('Y-m-d H:i:s',strtotime("last month"));
    $date_now =  date('Y-m-d H:i:s');

}
//right now it is difficult to update orders.shipped_date, use order date or invoices_date instead.
$sql = "
SELECT products.name , mytable.product_id, mytable.Qty, mytable.Total
FROM products INNER JOIN
(SELECT order_details.product_id, SUM(order_details.quantity) AS Qty,
SUM(order_details.unit_price * order_details.quantity) AS Total FROM orders
INNER JOIN order_details ON orders.id = order_details.order_id

INNER JOIN invoices ON invoices.order_id = orders.id
WHERE invoices.invoices_date BETWEEN '$last_month' AND '$date_now'

GROUP BY order_details.product_id) mytable
ON products.id = mytable.product_id";
/*

$sql = "
SELECT products.name , mytable.product_id, mytable.Qty, mytable.Total
FROM products INNER JOIN
(SELECT order_details.product_id, SUM(order_details.quantity) AS Qty,
SUM(order_details.unit_price * order_details.quantity) AS Total FROM orders
INNER JOIN order_details ON orders.id = order_details.order_id
WHERE orders.shipped_date BETWEEN '$last_month' AND '$date_now'
GROUP BY order_details.product_id) mytable
ON products.id = mytable.product_id";
*/

/*

$sql = "SELECT order_details.product_id, SUM(order_details.quantity) AS Qty, SUM(order_details.unit_price * order_details.quantity) AS Total FROM orders
INNER JOIN order_details ON orders.id = order_details.order_id 
WHERE orders.shipped_date BETWEEN '$last_month' AND '$date_now'
GROUP BY order_details.product_id";

*/


//echo $sql."<br>";
$result = mysqli_query($con, $sql);
echo "<h1></h1>";
echo "Time: From ". $last_month ." To ". $date_now . "<br>";
if(mysqli_num_rows($result) == 0){
    echo "No Results between $last_month and $date_now.";
}
else {
    $total = 0;
    while ($row = mysqli_fetch_array($result)) {
        echo "Product id: " . $row['product_id'];
        echo "Name: " . $row['name'];
        echo "Qty: " . $row['Qty'];
        echo "Total: " . $row['Total'];
        echo "<br>";
        $total = $total + $row['Total'];
    }
    setlocale(LC_MONETARY,"en_US");
    echo "Grand Total: ".money_format('%i',$total);
}
mysqli_free_result($result);


?>

<form action="sale_reports.php" method="get">
    From: <input name="time_start" type="time" placeholder="Time start" value="" autofocus required>
    To: <input name="time_end" type="time" placeholder="Time end" value="<?php echo date('Y-m-d H:i:s'); ?>" required><br>
    <label style="font-size: small">Hint: You can copy and adjust example time(current time) in the second field to complete this form.<br></label>
    <input name="submit" type="submit" value="Submit">

</form>

<a href="sale_reports.php">Default Monthly Sales Reports</a>(From Last Month to Now)<br>
