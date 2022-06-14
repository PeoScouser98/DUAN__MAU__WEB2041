<?php
// xóa toàn bộ tài đã lưu trong session
session_destroy();
setcookie('id', '', -1);
header("Location:./index.php");

// back lại về trang chủ
