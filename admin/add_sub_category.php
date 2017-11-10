<?php
require_once ('login_check_admin.php');
require_once ('../includes/db.php');
//insert into categories table
if(isset($_GET['main_type_id'])&&isset($_GET['category_name'])&&isset($_GET['category_desc'])) {
    $main_type_id = mysqli_real_escape_string($con,$_GET['main_type_id']);
    $category_name = mysqli_real_escape_string($con,strtolower($_GET['category_name']));
    $category_desc = mysqli_real_escape_string($con,ucwords($_GET['category_desc']));


    $sql_insert = "insert into categories (name, description, referto) VALUES ('$category_name', '$category_desc',$main_type_id)";
    //echo $sql_insert;
    mysqli_query($con, $sql_insert);
    header("location:add_sub_category.php");
}
?>
    <form action="add_sub_category.php" method="get">
        Main Type:
        <select name="main_type_id">
            <?php
            $result_type = mysqli_query($con, "select id, name from categories where referto = id");
            while($row_type = mysqli_fetch_array($result_type)){
                //echo $row_type['name'];
                //echo "<br>";
                ?>

                <option value="<?php echo $row_type['id']; ?>"><?php echo ucwords($row_type['name']) ?></option>

                <!-- <input type="radio" name="main_type_id" value="<?php // echo $row_type['id']; ?>"><?php //echo $row_type['name']; ?> -->
                <?php
            }
            mysqli_free_result($result_type);
            //add new sub category
            ?>
        </select><br>
        Category Name: <input type="text" name="category_name" placeholder="New category name" required><br>
        Description: <textarea name="category_desc" placeholder="" required></textarea><br>
        <input type="submit" value="Add">
    </form>
    <a href="add_product.php">Add New Product</a><br>

    Current Categories:
    <table>
        <tr><th>ID</th><th>Name</th><th>Description</th><th>Operation</th></tr>
        <?php
        $result_category_drinks = mysqli_query($con,"select * from categories WHERE referto = (SELECT id FROM categories WHERE name = 'drinks') ORDER  BY id");
        $cnt_drinks = mysqli_num_rows($result_category_drinks);
        ?>

        <tr><th colspan="4">Drinks<?php echo " ($cnt_drinks)"; ?></th></tr>

        <?php
        while($row_category_drinks = mysqli_fetch_array($result_category_drinks)){?>
            <tr>
                <td><?php echo $row_category_drinks['id']; ?></td>
                <td><?php echo $row_category_drinks['name'] ?></td>
                <td><?php echo $row_category_drinks['description']; ?></td>
                <td><a href='../includes/deletion.php?category_id=<?php echo $row_category_drinks['id'];?>'>delete</a></td>
            </tr>

            <?php
        }
        mysqli_free_result($result_category_drinks);
        ?>

        <?php
        $result_category_snacks = mysqli_query($con,"select * from categories WHERE referto = (SELECT id FROM categories WHERE name = 'snacks') ORDER  BY id");
        $cnt_snacks = mysqli_num_rows($result_category_snacks);
        ?>

        <tr><th colspan="4">Snacks<?php echo " ($cnt_snacks)"; ?></th></tr>

        <?php
        while($row_category_snacks = mysqli_fetch_array($result_category_snacks)){?>
            <tr>
                <td><?php echo $row_category_snacks['id']; ?></td>
                <td><?php echo $row_category_snacks['name'] ?></td>
                <td><?php echo $row_category_snacks['description']; ?></td>
                <td><a href='../includes/deletion.php?category_id=<?php echo $row_category_snacks['id'];?>'>delete</a></td>
            </tr>
            <?php
        }
        mysqli_free_result($result_category_snacks);
        mysqli_close($con);
        ?>



    </table>

<?php
/*
//get quantity of one main type
$sql_subtype = "SELECT temp1.cnt, temp2.name FROM
(SELECT count(name) as cnt, referto FROM categories WHERE referto != 0 GROUP by referto) temp1
INNER JOIN
(SELECT id, name FROM categories WHERE referto =0) temp2
ON temp1.referto = temp2.id";
$result_subtype = mysqli_query($con,$sql_subtype);
while ($row_subtype = mysqli_fetch_array($result_subtype)){
    echo $row_subtype['cnt'];
    echo $row_subtype['name'];
}

mysqli_free_result($result_subtype);
*/

?>