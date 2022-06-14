<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    $sql = "DELETE FROM users WHERE user_id = '{$id}'";
    execute_query($sql);
    header('Location:index.php?page=user-list');
}
