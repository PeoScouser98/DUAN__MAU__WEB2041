<?php
// lấy tất cả sản phẩm trong wish list
function get_wishList_items($userData)
{
    $sql = "SELECT * FROM  wish_list 
        INNER JOIN wish_list_detail ON wish_list.wish_list_id = wish_list_detail.wish_list_id 
        INNER JOIN product ON wish_list_detail.product_id = product.product_id
        WHERE user_id =  '{$userData['user_id']}'";
    return  select_all_records($sql);
}
// lấy ra mã wish list
function get_wishList_id($userData)
{
    return select_one_value("SELECT wish_list_id FROM wish_list WHERE user_id = '{$userData}'");
}
// thêm sản phẩm vào wish list
function add_to_wishlist($userData, $listId)
{
    if (!empty($_COOKIE['id'])) {
        $product_id = $_POST['product_id'];
        // check sản phẩm trùng trong wish list
        $wishListDetail = get_wishList_items($userData);
        $isDuplicated = false;
        foreach ($wishListDetail as $item) :
            if ($product_id == $item['product_id']) :
                $isDuplicated = true;
                echo "<script>swal('Product has been exist in wish list!')</script>";
                break;
            endif;
        endforeach;
        if ($isDuplicated == false) {
            $sql = "INSERT INTO wish_list_detail (wish_list_id,product_id) VALUES ('{$listId}','{$product_id}')";
            execute_query($sql);
            echo "<script>alert(`Added to wish list!`)</script>";
        }
    } else  echo "<script>alert(`Login to use this feature!`)</script>";
}
function del_wishList_item($id)
{
    execute_query("DELETE FROM wish_list_detail WHERE product_id = '{$id}'");
}
