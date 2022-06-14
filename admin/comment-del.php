<?php
if (isset($_GET['delId'])) {
    $delid   =  $_GET['delId'];
    $sql = "DELETE FROM comments WHERE comment_id = '{$delid}'";
    execute_query($sql);
    echo "<script>history.go(-1)</script>";
}
if (isset($_POST['delete-all']) && isset($_POST['delId'])) {
    print_r($_POST['delId']);
    if (is_array($_POST['delId'])) {
        foreach ($_POST['delId'] as $id) :
            execute_query("DELETE FROM comments WHERE comment_id = '{$id}'");
            echo "<script>history.go(-1)</script>";
        endforeach;
    }
}
