<?php
include './lib/execute_query.php';
include './lib/validate.php';
session_start();
if (isset($_POST['login-submit'])) {
    $account = $_POST['account'];
    $password = substr(md5($_POST['password'], false), 0, 20);
    if (empty($account) || empty($password)) :
        echo "<script>alert(`Please enter your account and password!`);</script>";
    endif;
    if (!empty($account) && !empty($password)) :
        $userData = select_single_record("SELECT * FROM users WHERE user_id = '{$account}'");
        if (!is_null($userData)) {
            if ($password == $userData['user_password']) {
                setcookie("id", $userData['user_id']);
                $_SESSION['user_name'] = $userData['user_name'];
                $userData['role_id'] == 1 ? header("Location: ./admin/") : header("Location:./?id={$account}");
            } else
                echo "<script>alert(`Account or password is incorrect!`)</script>";
        }
        // nếu kết quả trả về từ câu truy vẫn = null -> tài khoản không tồn tại
        else
            echo "<script>alert(`Account doesn't exist!`)</script>";
    endif;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="./styles/css/main.css" />
    <link rel="stylesheet" href="./styles/css/login.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>
<style>
    form {
        transform: translateY(-10%);
    }
</style>

<body>
    <div class="login-form-container d-flex justify-content-center align-items-center position-fixed top-0 w-100 h-100" style="background-image:linear-gradient(black, white)">
        <form action="" method="POST" id="login-form" class="d-flex justify-content-center flex-column align-items-center p-5" loading='lazy'>
            <!-- title -->
            <h1 class="fw-light text-white mb-5" style="font-size: 4em;">Login</h1>
            <p class="text-white">Please enter your account and password</p>
            <div class="d-flex justify-content-center flex-column align-items-center gap-2 w-100">
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="account" id="" aria-describedby="helpId" placeholder="Account" />
                </div>
                <div class="mb-3 w-100 w-100 h-auto">
                    <input type="password" class="form-control rounded-pill" name="password" id="" aria-describedby="helpId" placeholder="Password" />
                </div>
                <div class="mb-3 w-100 w-100 h-auto text-center">
                    <span class=" text-secondary">Do not have an account ?</span>
                    <a href="./register.php" class="text-white text-decoration-none">Register</a>
                </div>
                <div class="mb-3 w-100 w-100 h-auto d-flex justify-content-center">
                    <input type="submit" class="form-control btn rounded" name="login-submit" id="submit-btn" value="Login" />
                </div>
                <div class="mb-3 w-100 w-100 h-auto text-center">
                    <a href="./password-recover.php" class="text-white">Forgot password ?</a>
                </div>
            </div>
        </form>
    </div>
    <script>
        window.onload = function() {
            const form = document.querySelector('form');
            form.style.transitionDuration = "1s";
            form.style.transform = "translateY(0%)";
        }
    </script>
</body>

</html>