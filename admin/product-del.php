<?php
include '../lib/execute_query.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM product WHERE product_id = {$id}";
    execute_query($sql);
    header('Location: ./index.php?page=product-list');
}
