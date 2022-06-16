<?php
if (isset($_GET['delId'])) {
    $delid   =  $_GET['delId'];
    $sql = "DELETE FROM comments WHERE comment_id = '{$delid}'";
    execute_query($sql);
    echo "<script>window.location = '?page=comment-list'</script>";
}
if (isset($_POST['delete-all']) && isset($_POST['delId'])) {
    if (is_array($_POST['delId'])) {
        foreach ($_POST['delId'] as $id) :
            execute_query("DELETE FROM comments WHERE comment_id = '{$id}'");
        endforeach;
        echo "<script>window.location = '?page=comment-list'</script>";
    }
}
if (!isset($_GET['delId'])) {
    echo "<script>alert(`No item is chosen!`)</script>";
    echo "<script>window.location = '?page=comment-list'</script>";
}
