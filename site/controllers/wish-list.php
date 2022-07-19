<?php

// thêm sản phẩm vào wishlist
if (isset($_POST['add-to-wishlist'])) :
    add_to_wishlist('get_wishList_id');
endif;
// xóa sản phẩm trong wish list
if (isset($_GET['delid'])) :
    del_wishList_item($_GET['delid']);
    echo '<script>history.go(-1)</script>';
endif;
