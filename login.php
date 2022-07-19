<?php
include './library/execute_query.php';
// include './lib/validate.php';
session_start();
if (isset($_POST['login-submit'])) {
    $account = $_POST['account'];
    $password = $_POST['password'];
    if (empty($account) || empty($password))
        echo "<script>alert(`Please enter your account and password!`);</script>";
    if (!empty($account) && !empty($password)) :
        $userData = select_single_record("SELECT * FROM users WHERE user_id = '{$account}'");
        if (!is_null($userData)) {
            if (password_verify($password, $userData['user_password'])) {
                setcookie("id", $userData['user_id']);
                $_SESSION['user_name'] = $userData['user_name'];
                if ($userData['role_id'] == 1) {
                    echo  "<script>alert(`Login successfully!`)</script>";
                    echo  "<script>window.location = './admin/'</script>";
                } else {
                    echo  "<script>alert(`Login successfully!`)</script>";
                    echo  "<script>window.location = './'</script>";
                }
            } else
                echo "<script>alert(`Password is incorrect!`)</script>";
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
    <link rel="stylesheet" href="./site/view/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <script src="./view/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./site/view/styles/css/main.css">
    <link rel="stylesheet" href="./site/view/styles/css/login.css">
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <script src='https://unpkg.com/sweetalert/dist/sweetalert.min.js'></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center position-fixed top-0 w-100 h-100" style="background-image:linear-gradient(black, white)">
        <form action="" method="POST" id="form" class="d-flex justify-content-center flex-column align-items-center p-5" loading='lazy'>
            <!-- title -->
            <h1 class="fw-light text-white mb-5" style="font-size: 4em;">Login</h1>
            <div class="d-flex justify-content-center flex-column align-items-center gap-2 w-100">
                <div class="mb-3 w-100 h-auto">
                    <input type="text" class="form-control rounded-pill" name="account" id="" aria-describedby="helpId" placeholder="Account" />
                </div>
                <div class="mb-3 w-100 h-auto">
                    <input type="password" class="form-control rounded-pill" name="password" id="" aria-describedby="helpId" placeholder="Password" />
                </div>
                <div class="mb-3 w-100 h-auto text-center">
                    <span class=" text-secondary">Do not have an account ?</span>
                    <a href="./register.php" class="login-link text-white text-decoration-none">Register</a>
                </div>
                <div class="mb-5 w-100 h-auto d-flex justify-content-center">
                    <input type="submit" class="btn text-white rounded" name="login-submit" id="submit-btn" value="Login" />
                </div>
                <div class="w-100 h-auto text-center d-flex flex-column gap-3">
                    <a href="./password-recover.php" class="login-link text-white text-decoration-none">Forgot password ?</a>
                    <a href="./" class="login-link text-white text-decoration-none">Continue without login !</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>