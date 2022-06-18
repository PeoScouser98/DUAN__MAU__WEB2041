<?php

?>
<div class="header-top">
    <div class="container d-flex justify-content-between align-items-center container-fluid">
        <a href="./">
            <img src="../assets/img/Xshop-logo.png" alt="" class="logo img-fluid" style="max-width: 150px" />
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
<div class="header-menu">
    <nav class="navbar navbar-expand-lg" style="background-color:var(--primary)">
        <div class="container">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-start gap-3">
                    <!-- category -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=cate-list">Category List</a></li>
                            <li><a class="dropdown-item" href="?page=cate-add">Add New Category</a></li>
                        </ul>
                    </li>
                    <!-- product -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=product-list">Products List</a></li>
                            <li><a class="dropdown-item" href="?page=product-add">Add New Product</a></li>
                        </ul>
                    </li>
                    <!-- account -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="?page=ad-user-list" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=user-list">Users List</a></li>
                            <li><a class="dropdown-item" href="?page=user-add">Add New Account</a></li>
                        </ul>
                    </li>
                    <!-- order -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=order-list">Orders</a>
                    </li>
                    <!-- comment -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=comment-list">Comments</a>
                    </li>
                    <!-- statistic -->
                    <li class="nav-item">
                        <a class="nav-link" href="?page=statistic">Statistics</a>

                    </li>

                </ul>
                <!-- hiển thị thông tin đăng nhập ở đây -->
                <div class="d-flex justify-content-end align-items-center gap-3">
                    <img src=<?php echo $ROOT_AVATAR_ADMIN  . $userData['avatar'] ?> alt="" class="rounded-circle" id="header-avatar" style="max-width:60px">
                    <li class="nav-item dropdown d-block">
                        <a class="nav-link dropdown-toggle align-middle fw-bold" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?= (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : "" ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="?page=admin-profile">Account Settings</a></li>
                            <li><a class="dropdown-item" href="../logout.php">Sign Out</a></li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>
</div>