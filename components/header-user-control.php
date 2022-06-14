<div class="d-flex justify-content-end  gap-3">
    <img src=<?= $ROOT_AVATAR . $userData['avatar'] ?> alt="" id="header-avatar" class="rounded-circle" style="width:3rem;height:3rem;object-fit:cover">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-flex justify-content-end align-items-center gap-3">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle align-middle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= (isset($_SESSION['user_name'])) ? $_SESSION['user_name'] : "" ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: var(--primary)">
                <li><a class="dropdown-item" href="?page=profile&act=view-profile">Account Settings</a></li>
                <li><a class="dropdown-item" href="./logout.php">Sign Out</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?page=profile&act=view-wish-list"><i class="fas fa-heart"></i></a>
        </li>
        <li class="nav-item">
            <div class="position-relative" style="width:3rem">
                <a class="nav-link" href="index.php?page=cart-list#cart"><i class="fas fa-shopping-cart"></i></a>
                <span class="position-absolute top-0 bg-danger text-white rounded-circle text-center align-middle translate-y-50" style="width:1.5rem; height:1.5rem; right:0"><?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?></span>
            </div>
        </li>
    </ul>
</div>