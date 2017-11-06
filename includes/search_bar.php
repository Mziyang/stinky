<!-- search function -->
<div class="row">
    <div class="col-lg-6"></div>

    <div class="col-lg-6">
        <form class="" method="get" action="<?php if($_SERVER['PHP_SELF'] == "/stinky/index.php"){ echo "includes/";} ?>search.php">
            <div class="input-group">
                <input class="form-control" type="text" name="keyword" placeholder="Product Name"
                       value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; } ?>" required>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>