<?php
include './lib/global.php';
include './lib/execute_query.php';
include './lib/validate.php';
include './lib/add-wish-list.php';
include './lib/add-cart-list.php';
include './lib/render.php';
include './lib/send-mail.php';

if (isset($_COOKIE['id'])) {
    $id = $_COOKIE['id'];
    $userData = select_single_record("SELECT * FROM `users` WHERE `user_id` = '{$id}'");
}
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="./styles/css/main.css" />
    <link rel="stylesheet" href="./styles/css/product.css" />
    <link rel="stylesheet" href="./styles/css/cart-list.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="./node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="./node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
    <!-- sweat alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <header>
        <?php
        include './components/header-user.php';
        ?>
    </header>
    <main>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $path = "./page/{$page}.php";
        if (file_exists($path)) {
            require $path;
        }
        ?>
    </main>
    <footer style="background-color: var(--primary);">
        <?php
        include './components/footer-user.php';
        ?>
    </footer>
    <script type="text/javascript">
        const hideShadow = (btn) => {
            btn.style.boxShadow = "none";
        };
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel();
        });
        $("#carousel").owlCarousel({
            items: 4,
            margin: 20,
            autoHeight: false,
        });
    </script>
</body>

</html>