<?php
// đổi mật khẩu
function change_password($userData)
{
    if (empty($error)) {
        $currentPassword = $_POST['current_password'];
        if (password_verify($currentPassword, $userData['user_password'])) {
            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
            execute_query("UPDATE users SET user_password = '{$newPassword}' WHERE user_id = '{$userData['user_id']}'");
            echo "<script>alert(`Change password successfully!`);</script>";
        } else {
            echo "<script>alert(`Current password is incorrect!`);</script>";
        }
    } else {
        echo "<script>alert(`Fail to change password!`);</script>";
    }
}
// lấy thông tin người dùng
function get_user_data()
{
    if (isset($_COOKIE['id'])) {
        $id = $_COOKIE['id'];
        return select_single_record("SELECT * FROM `users` WHERE `user_id` = '{$id}'");
    }
}
