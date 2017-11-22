<!-- search function -->
<form class="form-inline my-2 my-lg-0" method="get" action="<?php if($_SERVER['PHP_SELF'] == "/stinky/index.php"){ echo "includes/";} ?>search.php">
    <input class="form-control mr-sm-2" type="text" name="keyword" placeholder="Search" aria-label="Search"
           value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; } ?>" required>
    <button type="submit" class="btn btn-outline-success my-2 my-sm-0">Search</button>

</form>
