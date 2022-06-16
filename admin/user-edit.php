<?php
$sql = "SELECT * FROM `user_role`";
$roles = select_all_records($sql);
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE user_id = '{$id}'";
    $user = select_single_record($sql);
}
$error = [];
?>

<div class="bg-white d-flex flex-column justify-content-start align-items-center gap-5 py-5" style="max-width:1200px; margin: 0 auto">
    <h1 class="text-center text-secondary">Edit Account</h1>
    <form action="" method="post" style="width: 40em">

        <!-- user id -->
        <div class="mb-3 d-none">
            <label for="account" class="form-label">Account</label>
            <input type="text" class="form-control" name="account" id="account" aria-describedby="helpId" value=<?= $user['user_id'] ?> disabled>
        </div>
        <!-- password -->
        <div class="mb-3 d-none">
            <label for="password" class="form-label">Password</label>
            <input type="password" min=0 class="form-control" name="password" id="password" aria-describedby="helpId" value=<?= $user['user_password'] ?> disabled>
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("password", "password");
                check_length('password', 8, 'password');
                ?>
            </small>
        </div>
        <!-- user name -->
        <div class="mb-3 ">
            <label for="username" class="form-label">What should we call you ?</label>
            <input type="text" name="username" id="username" class="form-control" value=<?= $user['user_name'] ?>>
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('username', "user's name");
                ?>
            </small>
        </div>
        <!-- email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" value=<?= $user['email'] ?> aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text fw-bold text-danger">
                <?php
                check_empty('email', 'email');
                check_email('email')
                ?>
            </small>
        </div>
        <!-- phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone number</label>
            <input type="text" min=0 class="form-control" name="phone" id="phone" aria-describedby="helpId" value=<?= $user['phone'] ?>>
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('phone', 'Phone number');
                check_phoneNumber('phone')
                ?>
            </small>
        </div>
        <!-- address -->
        <div class="mb-3 ">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control" value="<?php echo $user['address'] ?>">
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('address', 'address');
                ?>
            </small>
        </div>
        <!-- user role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-select" name="role" id="role">
                <option value="">-- Select --</option>
                <?php
                foreach ($roles as $role) {
                ?>
                    <option value=<?= $role['role_id'] ?> <?php echo $role['role_id'] == $user['role_id'] ? "selected" : "" ?>>
                        <?= ucfirst($role['role_name']) ?>
                    </option>
                <?php
                }
                ?>
            </select>
        </div>

        <!-- submit -->
        <div class="mb-3">
            <button type="button" onclick="clearFormData()" class="btn bg-transparent text-dark border-dark">Reset Form Data</button>
            <button type="submit" class="btn bg-dark text-white vertical-align-top" name="submit">Edit this account</button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit']) && isset($_GET['id'])) {
    if (empty($error)) {
        $id = $_GET['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
        $sql = "UPDATE users SET `user_name`= '{$username}',
                                 `email`= '{$email}',
                                 `address`=  '{$address}',
                                 `phone`= '{$phone}',
                                 `role_id`= '{$role}'
                             WHERE user_id = '{$id}'";
        execute_query($sql);
        echo "<script>window.location = '?page=user-list'</script>";
    } else {
        echo "<script>alert(`Check your information again!`)</script>";
    }
}
