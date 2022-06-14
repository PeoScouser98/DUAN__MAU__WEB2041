<?php
// place order
function place_order()
{
    if (isset($_POST['place-order'])) {
        if (!empty($_SESSION['cart'])) {
            $insertOrder_SQL = "INSERT INTO orders (`user_id`,`total_amount`,`placed_on`) VALUES ('{$_COOKIE['id']}', '{$_POST['total']}',CURRENT_TIMESTAMP())";
            $lastID = execute_query($insertOrder_SQL);
            // echo $lastID;
            foreach ($_SESSION['cart'] as $item) {
                execute_query("INSERT INTO order_detail (`order_id`,product_id,quantity,amount)
                            VALUES ('{$lastID}', '{$item['id']}', '{$item['qty']}', '{$item['total']}')");
                execute_query("UPDATE product SET stock = (stock - {$item['qty']}) WHERE product_id = {$item['id']}");
            }
            unset($_SESSION['cart']);
            echo "<script>alert(`Thank for buying our products!`);</script>";
            echo "<script>history.go(-1)</script>";
        } else echo "<script>alert(`Failed to place order!`)</script>";
    }
}
