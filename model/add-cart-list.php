<?php

/**
 * --------------------------
 * thêm sản phẩm vào giỏ hàng
 * --------------------------
 */
function add_cart()
{
    global $userData;
    if (isset($_SESSION['cart']) && isset($_POST['add-to-cart'])) {
        if (isset($_COOKIE['id']) &&  $userData['role_id'] != 1) {
            $cart_item = array(
                "id" => $_POST['product_id'],
                "image" => $_POST['product_img'],
                "name" => $_POST['product_name'],
                "price" => $_POST['price'],
                "qty" => $_POST['quantity'],
                "total" => $_POST['price'] * $_POST['quantity'],
            );
            $isDuplicated = false;
            if (!empty($_SESSION['cart'])) {
                for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                    if ($_SESSION['cart'][$i]['id'] == $cart_item['id']) {
                        $_SESSION['cart'][$i]['qty'] += $cart_item['qty'];
                        $isDuplicated = true;
                    }
                }
            }
            if (!$isDuplicated) array_push($_SESSION['cart'], $cart_item);
            echo "<script>alert(`Added To Cart!`);</script>";
            echo "<script>history.go(-1)</script>";
        } else echo "<script>alert(`You have to login to buy products!`)</script>";
    }
}
