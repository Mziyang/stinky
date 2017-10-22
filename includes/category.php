<form action="category.php" method="get">
    Category:
    <select name="category_id">

<?php
require_once('db.php');

//get two main types of products(drinks and snacks)
$result_type = mysqli_query($con, "select name from categories where referto = 0");
while($row_type = mysqli_fetch_array($result_type)){
    ?>


            <optgroup label="<?php echo ucwords($row_type['name']) ?>">

                <?php

                //get product sub types in one main type
                $type_name = $row_type['name'];

                $sql = "select id, name from categories temp WHERE temp.referto = (SELECT id from categories temp2 WHERE temp2.name = '$type_name')";
                //echo $sql;
                $result = mysqli_query($con, $sql);
                while($row = mysqli_fetch_array($result)){?>
                    <option value="<?php echo $row['id']; ?>"><?php echo ucwords($row['name']) ?></option>

                    <?php
                }
                mysqli_free_result($result);
                //end
                ?>


            </optgroup>



<?php

}
mysqli_free_result($result_type);
//end

?>

    </select>


    <input type="submit" value="Submit">
</form>

<?php
if (isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    mysqli_close($con);
}




