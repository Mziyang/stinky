<!-- search function -->
<div class="row">
    <div class="col-sm-8"></div>
    <div class="col-sm-4">
        <form class="" method="get" action="<?php if($_SERVER['PHP_SELF'] == "/stinky/index.php"){ echo "includes/";} ?>search.php">
            <div class="search-bar">
                <input type="text" name="keyword" placeholder="Product Name Required"
                       value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; } ?>" required>

                <button type="submit" class="btn">Search</button>
            </div>
        </form>
    </div>

</div>