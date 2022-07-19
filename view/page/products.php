<?php
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];
add_to_wishlist();
add_cart();
$itemLabel;
$sort = isset($_GET['sort']) ? $_GET['sort'] : '';
// lấy ra sản phẩm theo loại
if (isset($_GET['groupby'])) :
    if ($_GET['groupby'] == 'sale') :
        $pagination = paginate_page("SELECT COUNT(product_id)FROM product WHERE discount > 0  ", 9);
        $products = select_all_records("SELECT * FROM product WHERE discount > 0  ORDER BY product.price {$sort} LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
        $itemLabel = "On Sale";
    endif;
    if ($_GET['groupby'] == 'best-selling') :
        $itemLabel = "Best Selling";
        $pagination = paginate_page("SELECT COUNT(order_detail.product_id) FROM order_detail 
                                    INNER JOIN product ON product.product_id = order_detail.product_id ", 9);

        $products = select_all_records("SELECT  product.product_id,
                                            product_name,
                                            product_img,
                                            price,
                                            discount,
                                            stock,SUM(quantity) as sold, 
                                            SUM(amount) as turnover,
                                            MONTH(placed_on), 
                                            YEAR(NOW()) as year FROM product
                                        INNER JOIN order_detail  ON  product.product_id=  order_detail.product_id
                                        INNER JOIN orders  ON  orders.order_id =  order_detail.order_id
                                        WHERE MONTH(placed_on) = MONTH(NOW()) AND YEAR(placed_on) = YEAR(NOW()) AND orders.status_id = 2
                                        GROUP BY order_detail.product_id
                                        ORDER BY order_detail.amount DESC, product.price {$sort}");
    endif;
    if (is_numeric($_GET['groupby'])) :
        $pagination = paginate_page("SELECT COUNT(product_id) FROM product WHERE cate_id = {$_GET['groupby']}", 9);
        $products = select_all_records("SELECT * FROM product 
                                        INNER JOIN category ON product.cate_id = category.cate_id 
                                        WHERE product.cate_id = {$_GET['groupby']} 
                                        ORDER BY product.price {$sort}
                                        LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
        $itemLabel = !empty($products) ?  $products[0]['cate_name'] : "No Result";
    endif;
endif;
// lấy ra tất cả sản phẩm
if (!isset($_GET['groupby']) && !isset($_GET['keyword'])) :
    $itemLabel = "All Products";
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product", 9);
    $products = select_all_records("SELECT * FROM product ORDER BY price {$sort} LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
endif;
// lấy ra sản phẩm tìm kiếm theo từ khóa
if (isset($_GET['keyword'])) :
    $keyword = $_GET['keyword'];
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product
                                INNER JOIN category ON product.cate_id = category.cate_id
                                WHERE product.product_name LIKE  '%{$keyword}%'  
                                OR `category`.`cate_name` LIKE '%{$keyword}%'", 9);
    $sql = "SELECT * FROM product 
            INNER JOIN category ON product.cate_id = category.cate_id
            WHERE product.product_name LIKE  '%{$keyword}%'  
            OR category.cate_name LIKE '%{$keyword}%'
            ORDER BY product.price {$sort}
            LIMIT {$pagination['startIndex']}, {$pagination['qty']}";
    $products = select_all_records($sql);
    $itemLabel = !is_null($products) ? "Items: " . count($products) : "No Result";
endif;

?>

<div>
    <?php include './components/banner.php' ?>
</div>
<div class="container-fluid px-0" style="background-color: grey;">
    <div class="container row px-0 bg-white mx-auto">
        <!-- fixed aside menu -->
        <div class="col-3 px-0">
            <?php include './components/aside-menu.php'; ?>
        </div>
        <!-- product list -->
        <div class="container col-9 mx-auto px-0 py-5" style="max-width:100%">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <h3 id="cate"><?= $itemLabel ?></h3>
                </div>
                <div class="px-0 d-flex justify-content-end">
                    <select class="form-select w-auto" onchange="window.location = this.value">
                        <?php if (isset($_GET['groupby'])) : ?>
                            <option value=<?php echo "?page=products&groupby={$_GET['groupby']}&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&groupby={$_GET['groupby']}&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                        <?php if (isset($_GET['keyword'])) :  ?>
                            <option value=<?php echo "?page=products&keyword={$_GET['keyword']}&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&keyword={$_GET['keyword']}&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                        <?php if (!isset($_GET['groupby']) && !isset($_GET['keyword'])) :  ?>
                            <option value=<?php echo "?page=products&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <?php
            render_product_cards($products, $IMG_ROOT, $pagination);
            ?>
        </div>
    </div>
</div>