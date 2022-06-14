<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM category WHERE cate_id = {$id}";
    execute_query($sql);
    header('Location:./index.php?page=cate-list');
}
