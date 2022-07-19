<?php
include './library/execute_query.php';
include './library/global.php';
// include models
include './site/models/product.php';
include './site/models/user.php';
include './site/models/wish-list.php';
include './site/models/order.php';

// include controllers
include './site/controllers/product.php';
include './site/controllers/order.php';
include './site/controllers/user.php';
include './site/controllers/wish-list.php';
include './site/controllers/render.php';
include './site/controllers/cart-list.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
$userData = get_user_data();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Xshop</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- bootstrap -->
    <link rel="stylesheet" href="./site/view/node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/d2bf59f6fb.js" crossorigin="anonymous"></script>
    <!-- custom css -->
    <link rel="stylesheet" href="./site/view/styles/css/main.css" />
    <link rel="stylesheet" href="./site/view/styles/css/product.css" />
    <link rel="stylesheet" href="./site/view/styles/css/cart-list.css" />
    <!-- owl carousel -->
    <link rel="stylesheet" href="./site/view/node_modules/owl.carousel/dist/assets/owl.carousel.min.css" />
    <script src="./site/view/node_modules/jquery/dist/jquery.js"></script>
    <script src="./site/view/node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
</head>

<body>
    <header>
        <?php
        include './site/view/components/header-user.php';
        ?>
    </header>
    <main>
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $route = "./site/view/page/{$page}.php";
        if (file_exists($route))
            require $route;
        else echo '<h1>Page not found</h1>';
        ?>
    </main>
    <footer style="background-color: var(--primary);">
        <?php
        include './view/components/footer.php';
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