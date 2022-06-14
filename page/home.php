<?php
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];
add_to_wishlist();
add_cart();
?>
<div>
    <?php include './components/banner.php' ?>
</div>
<div class="container-fluid" style="background-color:grey ;">
    <div class="container d-flex flex-column gap-5 p-5 bg-white">
        <!-- top 10 sản phẩm bán chạy -->
        <div class="container border-bottom">
            <div class="bg-dark d-flex justify-content-center align-items-center position-relative py-5" style="box-shadow: inset 0 0 0 1px gray ;">
                <h1 class="text-center text-white text-uppercase">best selling products</h1>
                <img src="/ecommerce/assets/img/best-seller.png" class="img-fluid mx-auto position-absolute top-50 start-0 translate-middle" style="max-width:300px; z-index:100;">
            </div>
            <?php render_product_slider("SELECT * FROM product 
                            INNER JOIN order_detail ON product.product_id = order_detail.product_id
                            GROUP BY product_name
                            ORDER BY order_detail.amount
                            DESC limit 0,10"); ?>
        </div>
        <!-- các sản phẩm đang sale -->
        <div class="container border-bottom">
            <img src="/ecommerce/assets/img/sales_banners.jpg" class="img-fluid d-block mx-auto" alt="">
            <?php render_product_slider("SELECT * FROM product WHERE discount>0") ?>
        </div>
        <!-- các sản phẩm mới nhập -->
        <div class="container">
            <div class="bg-dark py-5">
                <h1 class="text-center text-white text-uppercase">New Products</h1>
            </div>
            <div class="">
                <?php render_product_slider("SELECT * FROM product ORDER BY product_id DESC LIMIT 0,10") ?>
            </div>
        </div>
    </div>

</div>