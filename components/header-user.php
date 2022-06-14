<div class="header-top">
    <div class="d-flex justify-content-between align-items-center container">
        <a href="http://localhost:8080/ecommerce/?page=home">
            <img src="./assets/img/Xshop-logo.png" alt="" class="logo img-fluid" style="max-width: 150px" />
        </a>
        <div class="header-contact">
            <ul class="d-flex justify-content-end gap-5">
                <li class="d-flex justify-content-center gap-2">
                    <span style="color: var(--secondary)"><i class="fas fa-phone-alt"></i></span>
                    <span>0336089988</span>
                </li>
                <li class="d-flex justify-content-center gap-2">
                    <span style="color: var(--secondary)"><i class="fas fa-envelope"></i></span>
                    <span>xshop@gmail.com</span>
                </li>
                <li class="d-flex justify-content-center gap-2">
                    <span style="color: var(--secondary)"><i class="fas fa-map-marker-alt"></i></span>
                    <span>FPT Poly/ Trinh Van Bo/ Nam Tu Liem/ Ha Noi</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="header-menu position-sticky top-0" style="z-index: 100;">
    <nav class="navbar navbar-expand-lg" style="background-color: var(--primary);">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-start gap-3">
                    <!-- Home -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=home">Home</a>
                    </li>
                    <!-- Products -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=products#cate">Products</a>
                    </li>
                    <!-- statistic -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=contact">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=about-us">About Us</a>
                    </li>
                </ul>
                <?php
                include isset($_COOKIE['id']) ? './components/header-user-control.php' : './components/header-user-login.php';
                ?>
            </div>
        </div>
    </nav>
</div>
<script type="text/javascript">
</script>