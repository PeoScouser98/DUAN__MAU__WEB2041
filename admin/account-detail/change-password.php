<?php
$error = [];
?>

<div class="container">
    <h1 class="mb-5">Change Password</h1>
    <form action="" method="post" id="form">
        <div class="mb-3">
            <label for="" class="form-label">Current Password</label>
            <input type="password" class="form-control w-100 " name="password" aria-describedby="helpId" id="password" value=<?= $userData['user_password'] ?>>
            <small class="error-message text-danger fw-bold" class="form-text text-muted">
                <?php
                check_empty('password', 'password');
                ?>
            </small>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">New Password</label>
            <input type="password" class="form-control w-100" name="new_password" id="cfm-password" aria-describedby="helpId" placeholder="">
            <small class="error-message text-danger fw-bold" class="form-text text-muted">
                <?php
                check_empty('new_password', 'new password');
                check_length('new_password', 8, 'new password');
                ?>
            </small>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Confirm New Password</label>
            <input type="password" class="form-control w-100" name="cfm_password" id="" aria-describedby="helpId" placeholder="">
            <small class="error-message text-danger fw-bold" class="form-text text-muted">
                <?php
                check_empty('cfm_password', 'confirm password');
                check_matching('password', 'cfm_password', 'confirm password')
                ?>
            </small>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-dark" name="change-password">Change Password</button>
        </div>
    </form>
</div>
<script src="/ecommerce/js/validate.js"></script>


<?php
if (isset($_POST['change-password'])) :
    if (empty($error)) :
        execute_query("UPDATE users SET user_password = '{$_POST['new_password']}' WHERE user_id = '{$userData['user_id']}'");
        echo "<script>alert(`Change password successfully!`);</script>";
        echo "<script>window.location.reload()</script>";

    endif;
endif;
