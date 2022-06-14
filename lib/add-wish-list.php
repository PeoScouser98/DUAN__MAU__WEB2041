<?php
// ADD TO WISH LIST
function add_to_wishlist()
{
    if (isset($_POST['add-to-wishlist'])) :
        if (!empty($_COOKIE['id'])) {
            $product_id = $_POST['product_id'];
            // check sản phẩm trùng trong wish list
            $wishListDetail = select_all_records("SELECT * FROM wish_list_detail
                                                    INNER JOIN wish_list ON wish_list.wish_list_id = wish_list_detail.wish_list_id
                                                    WHERE user_id = '{$_COOKIE['id']}'");
            $isDuplicated = false;
            foreach ($wishListDetail as $item) :
                if ($product_id == $item['product_id']) :
                    $isDuplicated = true;
                    echo "<script>swal('Product has been exist in wish list!')</script>";
                    break;
                endif;
            endforeach;
            if ($isDuplicated == false) {
                $wishListId = select_one_value("SELECT wish_list_id FROM wish_list WHERE user_id = '{$_COOKIE['id']}'");
                $sql = "INSERT INTO wish_list_detail (wish_list_id,product_id) VALUES ('{$wishListId}','{$product_id}')";
                execute_query($sql);
                echo "<script>alert(`Added to wish list`)</script>";
            }
        } else echo "<script>swal({
            title: 'Login to use this feature!',
            icon: 'error',
            button: false,
            timer: 1500,
            });</script>";
    endif;
}
