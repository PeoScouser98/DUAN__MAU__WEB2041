<?php
include '../lib/execute_query.php';
include '../lib/global.php';
include '../lib/validate.php';
session_start();
unset($_SESSION['cart']);
if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    $userData = select_single_record("SELECT * FROM `users` WHERE `user_id` = '{$id}'");
}
$ROOT_AVATAR = "/ecommerce/assets/img/avatar/";
$ROOT_PRODUCT_IMG = "/ecommerce/assets/img/products/";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../styles/css/main.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function clearFormData() {
            const inputs = document.querySelectorAll('input');
            for (const input of inputs) {
                if (!input.hasAttribute("disabled"))
                    input.value = "";
            }
        }
    </script>
</head>

<body>
    <!-- header -->
    <header>
        <?php
        $userData['role_id'] == 1 ? include '../components/header-admin.php' : header("Location: ../login.php");
        ?>
    </header>
    <main>
        <div class="container bg-white">
            <?php
            $page = isset($_GET['page']) ? $_GET['page'] : 'cate-list';
            $path = "./{$page}.php";
            if (file_exists($path)) {
                require $path;
            } else {
                echo "<h1 class='text-muted'>404 NOT FOUND</h1>";
            }
            ?>
        </div>
    </main>
</body>

</html>