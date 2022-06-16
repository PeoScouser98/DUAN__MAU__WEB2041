<?php
$error = [];
$sql = "SELECT * FROM `user_role`";
$roles = select_all_records($sql);
?>
<div class="container bg-white d-flex flex-column justify-content-center align-items-center gap-5 py-5" style="max-width:1200px; margin: 0 auto">
    <h1 class="text-center text-secondary">Create Account</h1>
    <form action="" method="post" enctype="multipart/form-data" style="width: 40em">

        <!-- user id -->
        <div class="mb-3 ">
            <label for="account" class="form-label">Account</label>
            <input type="text" class="form-control" name="account" id="account" aria-describedby="helpId" placeholder="">
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("account", "account");
                ?>
            </small>
        </div>
        <!-- password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" min=0 class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("password", "password");
                check_length('password', 8, 'password');
                ?>
            </small>
        </div>
        <!-- confirm password -->
        <div class="mb-3">
            <label for="cfm-password" class="form-label">Confirm your password</label>
            <input type="password" min=0 class="form-control" name="cfm_password" id="cfm-password" aria-describedby="helpId" placeholder="">
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("cfm_password", "confirm password");
                check_matching('password', 'cfm_passworrd', 'confirm password');
                ?>
            </small>
        </div>
        <!-- user name -->
        <div class="mb-3 ">
            <label for="username" class="form-label">What should we call you ?</label>
            <input type="text" name="username" id="username" class="form-control">
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('username', "user's name");
                ?>
            </small>
        </div>
        <!-- email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="" aria-describedby="fileHelpId">
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
            <input type="text" min=0 class="form-control" name="phone" id="phone" aria-describedby="helpId" placeholder="">
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
            <input type="text" name="address" id="address" class="form-control">
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('address', 'address');
                ?>
            </small>
        </div>
        <!-- user role -->
        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select class="form-control" name="role" id="role">
                <option value="">-- Select --</option>
                <?php
                foreach ($roles as $role) {
                ?>
                    <option value=<?php echo $role['role_id'] ?>><?= ucfirst($role['role_name']) ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <!-- submit -->
        <div class="mb-3">
            <button type="button" onclick="clearFormData()" class="btn bg-transparent text-dark border-dark">Reset All Data</button>
            <button type="submit" name="submit" class="btn btn-dark">Add New Account</button>
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    if (empty($error)) {
        $account = $_POST['account'];
        $password = $_POST['password'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = $_POST['role'];
        $sql = "INSERT INTO users (`user_id`,`user_password`,`user_name`,`email`,`address`,`phone`,`role_id`)
                VALUE('{$account}','{$password}','{$username}','{$email}','{$address}','{$phone}','{$role}')";
        execute_query($sql);
        execute_query("INSERT INTO wish_list (user_id) VALUES ('{$account}')");
    } else {
        echo "<script>alert(`Check your information again!`)</script>";
    }
}
