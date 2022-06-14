<?php
$categories = select_all_records("SELECT * FROM category");
?>
<div class="wrapper d-flex position-sticky top-0 d-sm-none d-xxl-block w-100">
    <div class="sidebar">
        <form action="?page=products" method="GET" class="mb-5">
            <div class="input-group rounded-pill d-flex align-items-center gap-2 px-2 border border-1 border-dark">
                <input type="hidden" name="page" value="products">
                <input type="text" name="keyword" class="form-control rounded-pill border-0 bg-transparent" id="search-input" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                <button type="submit" class="border-0" style="background-color: transparent"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="text-left">
            <li><a href="index.php?page=products#cate"><i class="bi bi-card-list"></i><span class="px-2">All</span></a></li>
            <?php
            if (is_array($categories)) {
                foreach ($categories as $cate) {
            ?>
                    <li>
                        <a href=<?php echo "?page=products&groupby={$cate['cate_id']}#cate" ?>><?= $cate['cate_icon'] ?>
                            <span class="px-2"><?= $cate['cate_name'] ?></span>
                        </a>
                    </li>
            <?php
                }
            }
            ?>
            <li><a href="?page=products&groupby=sale#cate"><i class="bi bi-tags"></i><span class="px-2">On Sale</span></a></li>
            <li><a href="?page=products&groupby=best-selling#cate"><i class="bi bi-heart"></i><span class="px-2">Best Selling</span></a></li>
        </ul>

    </div>
</div>