<!-- search function -->
<div class="float-right">
    <form class="" method="get" action="search.php">
        <div class="search-bar">
            <input type="text" name="keyword" class="search-text" placeholder="Product Name Required"
                   value="<?php if(isset($_GET['keyword'])) { echo $_GET['keyword']; } ?>" required>

            <button type="submit" class="btn">Search</button>
        </div>
    </form>
</div>






