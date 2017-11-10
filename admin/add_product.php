<?php
require_once('login_check_admin.php');
require('../includes/db.php');
if (
    !empty($_POST['name'])&&
    !empty($_POST['brand'])&&
    !empty($_POST['category_id'])&&
    //!empty($_POST['flavor'])&&
    !empty($_POST['size'])&&
    !empty($_POST['description'])&&
    !empty($_POST['unit_price'])&&
    !empty($_POST['expiration_date'])&&
    !empty($_POST['date_added'])&&
    !empty($_POST['store_price'])&&
    !empty($_POST['inventory'])){
	$name=mysqli_real_escape_string($con,$_POST['name']);
	$brand=mysqli_real_escape_string($con,$_POST['brand']);
    $category_id=mysqli_real_escape_string($con,$_POST['category_id']);
    $flavor=mysqli_real_escape_string($con,$_POST['flavor']);
    $size=mysqli_real_escape_string($con,$_POST['size']);
    $description=mysqli_real_escape_string($con,$_POST['description']);
    $unit_price=mysqli_real_escape_string($con,$_POST['unit_price']);
    $expiration_date=mysqli_real_escape_string($con,$_POST['expiration_date']);
    $date_added=mysqli_real_escape_string($con,$_POST['date_added']);
    $store_price=mysqli_real_escape_string($con,$_POST['store_price']);
    $inventory=mysqli_real_escape_string($con,$_POST['inventory']);
    $sql="insert into products( name, brand, category_id, flavor, size, description, unit_price, expiration_date, date_added, store_price, inventory) 
values ('$name', '$brand', $category_id, '$flavor', '$size', '$description', $unit_price, '$expiration_date', '$date_added', '$store_price', $inventory)";
    //echo $sql;
    $result = mysqli_query($con, $sql);
    if (mysqli_insert_id($con) == 0) { echo"The product you have added. You don't need to add again. <a href=\"new.php\">add exist products(update inventory only)</a>"; }
    else{
        echo "Products Added!";
    }
}
else echo"Please fill all the information!";
?>
<form action="add_product.php" method="POST">
Name:<input type="text" name="name" value="<?php if(isset($_POST['name'])){echo htmlentities($_POST['name']);} ?>"><br/>
Brand:<input type="text" name="brand" value="<?php if(isset($_POST['brand'])){echo $_POST['brand'];} ?>"><br/>
Category:<select name="category_id">

        <?php
        require_once('../includes/db.php');

        //get two main types of products(drinks and snacks)
        $result_type = mysqli_query($con, "select name from categories where referto = id");
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
        mysqli_close($con);
        ?>

    </select><a href="add_sub_category.php">Add Product Category?</a> <br/>
Flavor:<input type="text" name="flavor" value="<?php if(isset($_POST['flavor'])){echo $_POST['flavor'];} ?>" placeholder="Leave blank if none"><br/>
Size:<input type="text" name="size" value="<?php if(isset($_POST['size'])){echo htmlentities($_POST['size']);} ?>"><br/>
Description:<input type="text" name="description" value="<?php if(isset($_POST['description'])){echo htmlentities($_POST['description']);} ?>"><br/>
Unit Price:<input type="text" name="unit_price" value="<?php if(isset($_POST['unit_price'])){echo htmlentities($_POST['unit_price']);} ?>"><br/>
Expiration_date:<input type="text" name="expiration_date" value="<?php if(isset($_POST['expiration_date'])){echo $_POST['expiration_date'];} ?>"><br/>
Date Added:<input type="text" name="date_added" value="<?php if(isset($_POST['date_added'])){echo $_POST['date_added'];} else{ echo date('Y-m-d H:i:s'); } ?>"><br/>
Store Price:<input type="text" name="store_price" value="<?php if(isset($_POST['store_price'])){echo $_POST['store_price'];} ?>"><br/>
Inventory:<input type="text" name="inventory" value="<?php if(isset($_POST['inventory'])){echo htmlentities($_POST['inventory']);} ?>"><br/>
    <input type="submit" value="Add New Product">
</form>
<a href="../index.php">Back to home</a>
<a href="add_sub_category.php">Add New Sub Category</a>
<a href="">Add new product</a>
<a href="../includes/list_all.php">Veiw All Products</a>