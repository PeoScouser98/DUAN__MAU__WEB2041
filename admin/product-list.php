<?php
$categories = select_all_records("SELECT * FROM category");
$QTY_EACH_PAGE = 5;
if (isset($_GET['groupby'])) {
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product WHERE product.cate_id = {$_GET['groupby']}", $QTY_EACH_PAGE);
    extract($pagination);
    $productList = select_all_records("SELECT * FROM product 
                                        INNER JOIN category ON product.cate_id = category.cate_id 
                                        WHERE product.cate_id = {$_GET['groupby']}
                                        LIMIT {$startIndex}, {$qty}");
} else {
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product ", $QTY_EACH_PAGE);
    extract($pagination);
    $productList = select_all_records("SELECT * FROM product 
                                        INNER JOIN category ON product.cate_id = category.cate_id 
                                        LIMIT {$startIndex}, {$qty}");
}
?>
<style>
    .scroll {
        max-width: 15rem;
        overflow: auto;
        padding: 10px;
    }

    .scroll::-webkit-scrollbar {
        width: 5px;
    }

    .scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .scroll::-webkit-scrollbar-thumb {
        background-color: lightgray;
        height: 50px;
        border-radius: 10px;
    }
</style>

<div class="container bg-white py-5">
    <h1 class="text-center mb-5">Product List</h1>
    <div class="mb-3">
        <select class="form-select  w-auto" onchange="window.location = this.value">
            <option value="?page=product-list">All</option>
            <?php
            foreach ($categories as $cate) :
                extract($cate);
            ?>
                <option value=<?= "?page=product-list&groupby={$cate_id}" ?> <?php echo isset($_GET['groupby']) && $_GET['groupby'] == $cate_id ? "selected" : "" ?>><?= $cate_name ?></option>
            <?php
            endforeach;
            ?>
        </select>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Product's name</th>
                <th>In Stock</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Image</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($productList)) {
                foreach ($productList as $product) :
            ?>
                    <tr>
                        <td><?= $product['product_id'] ?></td>
                        <td><?= $product['cate_name'] ?></td>
                        <td><?= $product['product_name'] ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td><?= $product['discount'] ?></td>
                        <td><img src=<?= $IMG_ROOT_ADMIN .  $product['product_img'] ?> style="max-width:100px; height:100px; object-fit:contain"></td>
                        <td>
                            <div class="scroll" style="height: 100px;"><?= $product['product_description'] ?></div>
                        </td>
                        <td>
                            <a href=<?php echo "?page=product-edit&id={$product['product_id']}" ?> class="btn border-2 border-dark">Edit</a>
                            <a href=<?php echo "./product-del.php?id={$product['product_id']}" ?> class="btn btn-danger" onclick="return confirm(`Are you sure ?`) ">Delete</a>
                        </td>
                    </tr>
            <?php
                endforeach;
            } else
                echo "<tr><td colspan='9' class='text-center text-danger fw-bold py-5'>There is no products</td></tr>";

            ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-center align-items-center gap-2">
        <?php
        if (isset($_GET['groupby']))
            for ($i = 1; $i <= $lastIndex; $i++) {
                echo "<a href='?page=product-list&groupby={$_GET['groupby']}&tabindex={$i}' role='button' class='btn btn-dark'>{$i}</a>";
            }
        else
            for ($i = 1; $i <= $lastIndex; $i++) {
                echo "<a href='?page=product-list&tabindex={$i}' role='button' class='btn btn-dark'>{$i}</a>";
            }
        ?>
    </div>
</div>