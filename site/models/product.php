<?php
// lấy ra tất cả sản 
function get_all_products()
{
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product", 9);
    $products = select_all_records("SELECT * FROM product ORDER BY price*( 1- discount/100) {$sort} LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
    return [
        "pagination" => $pagination,
        "label" => "All Products",
        "products" => $products
    ];
}
// lấy ra sản phẩm giảm giá
function get_products_onsale()
{
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product WHERE discount > 0 ", 9);
    $products =  select_all_records("SELECT * FROM product WHERE discount > 0 ORDER BY product.price*(1-product.discount/100) {$sort} LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
    return [
        "products" => $products,
        "label" => "On Sale",
        "pagination" => $pagination
    ];
}
// lấy ra sản phẩm bán chạy
function get_products_best_seller()
{
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(order_detail.product_id) FROM order_detail GROUP BY product_id", 9);
    $products = select_all_records("SELECT product.product_id,product_name,product_img,price,discount,stock,SUM(quantity) as sold,SUM(amount) as turnover,MONTH(placed_on),YEAR(NOW()) as year FROM product
                                    INNER JOIN order_detail ON product.product_id = order_detail.product_id
                                    INNER JOIN orders ON orders.order_id = order_detail.order_id
                                    WHERE MONTH(placed_on) = MONTH(NOW()) AND YEAR(placed_on) = YEAR(NOW()) AND orders.status_id = 2
                                    GROUP BY order_detail.product_id
                                    ORDER BY product.price*(1-product.discount/100) {$sort}");
    return [
        "products" => $products,
        "label" => "Best Seller",
        "pagination" => $pagination
    ];
}
// lấy ra sản phẩm theo danh mục
function get_products_by_cate()
{
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product WHERE cate_id = {$_GET['groupby']}", 9);
    $products = select_all_records("SELECT * FROM product
                                    INNER JOIN category ON product.cate_id = category.cate_id
                                    WHERE product.cate_id = {$_GET['groupby']}
                                    ORDER BY product.price*(1-product.discount/100) {$sort}
                                    LIMIT {$pagination['startIndex']}, {$pagination['qty']}");
    return [
        "products" => $products,
        "label" => $products[0]['cate_name'],
        "pagination" => $pagination
    ];
}
// lấy ra sản phẩm tìm kiếm theo từ khóa
function get_products_by_keyword()
{
    $keyword = $_GET['keyword'];
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product
            INNER JOIN category ON product.cate_id = category.cate_id
            WHERE product.product_name LIKE '%{$keyword}%'
            OR `category`.`cate_name` LIKE '%{$keyword}%'", 9);
    $sql = "SELECT * FROM product
            INNER JOIN category ON product.cate_id = category.cate_id
            WHERE product.product_name LIKE '%{$keyword}%'
            OR category.cate_name LIKE '%{$keyword}%'
            ORDER BY product.price*(1-product.discount/100) {$sort}
            LIMIT {$pagination['startIndex']}, {$pagination['qty']}";
    $products = select_all_records($sql);
    return [
        "products" => $products,
        "label" => 'Items: ' . $pagination['lastIndex'],
        "pagination" => $pagination
    ];
}
// lấy ra sản phẩm mới nhập
function get_new_products()
{

    $keyword = $_GET['keyword'];
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $pagination = paginate_page("SELECT COUNT(product_id) FROM product
            INNER JOIN category ON product.cate_id = category.cate_id
            WHERE product.product_name LIKE '%{$keyword}%'
            OR `category`.`cate_name` LIKE '%{$keyword}%'", 9);
    $sql = "SELECT * FROM product ORDER BY product_id DESC LIMIT 0,10";
    $products = select_all_records($sql);
    // associated array
    return [
        "products" => $products,
        "label" => 'Items: ' . $pagination['lastIndex'],
        "pagination" => $pagination
    ];
}
// xóa sản phẩm
function delete_product()
{
}
// thêm sản phẩm
function add_product()
{
}
// sửa sản phẩm
function edit_product()
{
}
