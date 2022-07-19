<?php
function place_order()
{
    if (!empty($_SESSION['cart'])) {
        $lastID = execute_query("INSERT INTO orders (`user_id`,`total_amount`,`placed_on`) 
                                VALUES ('{$_COOKIE['id']}', '{$_POST['total']}',CURRENT_TIMESTAMP())");
        foreach ($_SESSION['cart'] as $item) {
            execute_query("INSERT INTO order_detail (`order_id`,product_id,quantity,amount)
                            VALUES ('{$lastID}', '{$item['id']}', '{$item['qty']}', '{$item['total']}')");
            execute_query("UPDATE product SET stock = (stock - {$item['qty']}) WHERE product_id = {$item['id']}");
        }
        unset($_SESSION['cart']);
        echo "<script>alert(`Thank for buying our products!`);</script>";
        echo "<script>window.location = window.location.href</script>";
    } else echo "<script>alert(`Failed to place order!`)</script>";
}
function get_all_orders($userData)
{
    return select_all_records(
        "SELECT * FROM `orders` 
        INNER JOIN `order_status` ON `orders`.`status_id` = `order_status`.`status_id` 
        WHERE user_id =  '{$userData['user_id']}'
        ORDER BY MONTH(placed_on) DESC, DAY(placed_on) DESC"
    );
}
