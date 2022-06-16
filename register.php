<?php
include './lib/validate.php';
include './lib/execute_query.php';
$error = [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/css/login.css">
    <link rel="stylesheet" href="./styles/css/main.css" />
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>

<body>
    <div class="login-form-container d-flex justify-content-center align-items-center position-fixed top-0 w-100 h-100" style="background-image:linear-gradient(black, white)">
        <form action="./register.php" method="POST" enctype="multipart/form-data" id="login-form" class="d-flex justify-content-center flex-column align-items-center p-5">
            <!-- title -->
            <h1 class="fw-light text-white" style="font-size: 4em">Register</h1>
            <p class="text-white">Sign up for free to shopping</p>
            <div class="d-flex justify-content-center flex-column align-items-center gap-2 w-100">
                <!-- account -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="account" id="" aria-describedby="helpId" placeholder="Account" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('account', 'account');
                        check_length('account', 8, 'account');
                        ?>
                    </small>
                </div>
                <!-- password -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="password" class="form-control rounded-pill" name="password" id="" aria-describedby="helpId" placeholder="Password" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('password', 'password');
                        check_length('password', 8, 'password');
                        ?>
                    </small>
                </div>
                <!-- confirm password -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="password" class="form-control rounded-pill" name="cfm_password" id="" aria-describedby="helpId" placeholder="Confirm Password" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('cfm_password', 'confirm password');
                        check_matching('password', 'cfm_password', 'confirm password');
                        ?>
                    </small>
                </div>
                <!-- Email -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="email" class="form-control rounded-pill" name="email" id="" aria-describedby="helpId" placeholder="Email" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('email', 'email');
                        check_email('email');
                        ?>
                    </small>
                </div>
                <!-- address -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="address" id="" aria-describedby="helpId" placeholder="Address" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('address', 'address');
                        ?>
                    </small>
                </div>
                <!-- phone -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="phone" id="" aria-describedby="helpId" placeholder="Your Phone Number" />
                    <small class="text-danger fw-bold">
                        <?php
                        if (!check_empty('phone', 'phone number'))
                            check_phoneNumber('phone');
                        ?>
                    </small>
                </div>
                <!-- user's name -->
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="username" id="" aria-describedby="helpId" placeholder="What should we call you?" />
                    <small class="text-danger fw-bold">
                        <?php
                        check_empty('username', "user's name");
                        ?>
                    </small>
                </div>
                <!-- submit form -->
                <div class="mb-3 w-100 w-100 h-auto d-flex justify-content-center">
                    <input type="submit" class="form-control btn rounded" name="signup-submit" id="submit-btn" value="Sign Up" />
                </div>
            </div>
            <div class="mt-3">
                <span class="text-muted">Already have an account?</span>
                <a href="./login.php" class="text-white">Login</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php

if (isset($_POST['signup-submit'])) {
    if (empty($error)) {
        $account = $_POST['account'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $role = select_one_value("SELECT role_id FROM user_role WHERE role_name='client'");
        $sql = "INSERT INTO users (`user_id`,`user_password`,`user_name`,`email`,`address`,`phone`,`role_id`)
                VALUE('{$account}','{$password}','{$username}','{$email}','{$address}','{$phone}','{$role}')";
        execute_query($sql);
        execute_query("INSERT INTO wish_list (user_id) VALUES ('{$account}')");
    }
}
