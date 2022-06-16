<?php
// xóa toàn bộ tài khoản đã lưu trong session
session_destroy();
setcookie('id', '', -9999);
header("Location:./");
// back lại về trang chủ
