<?php
$error = [];
?>

<div class="container">
    <h1 class="mb-5">Edit Account</h1>
    <form action="" method="post">
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
            <input type="email" class="form-control" name="email" id="email" aria-describedby="fileHelpId">
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
            <input type="text" min=0 class="form-control" name="phone" id="phone" aria-describedby="helpId">
            <small class="form-text fw-bold text-danger">
                <?php
                check_empty('phone', "phone numberr");
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
        <!-- submit -->
        <div class="mb-3">
            <button type="button" onclick="clearFormData()" class="btn bg-transparent text-dark border-dark">Reset All Data</button>
            <button type="submit" class="btn bg-dark text-white vertical-align-top" name="submit">Edit Profile</button>
        </div>
    </form>
</div>
<?php
if (isset($_POST['submit']) && isset($_COOKIE['id'])) {
    if (empty($error)) {
        $id = $_COOKIE['id'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $sql = "UPDATE users SET `user_name`= '{$username}',
                                 `email`= '{$email}',
                                 `address`=  '{$address}',
                                 `phone`= '{$phone}'
                             WHERE user_id = '{$id}'";
        execute_query($sql);
        echo "<script>alert(`Edit your profile successfully!`)</script>";
        echo "<script>history.go(-1)</script>";
    } else {
        echo "<script>alert(`Check your information again!`)</script>";
    }
}
