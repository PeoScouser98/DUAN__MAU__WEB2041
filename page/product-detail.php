<?php
if (isset($_GET['view'])) {
    $id = $_GET['view'];
    $comment_sql = "SELECT comment_id,content,users.user_id,users.user_name,users.avatar, YEAR(comment_date) as cmt_year,MONTH(comment_date) as cmt_mon,DAY(comment_date) as cmt_day FROM comments 
                    INNER JOIN `users` ON `comments`.`user_id` = `users`.`user_id`
                    WHERE product_id = {$id}
                    ORDER BY comment_id DESC";
    $sql = "SELECT * FROM `product` WHERE `product_id` = {$id}";
    $product = select_single_record($sql);
    $comments = select_all_records($comment_sql);
    // print_r($comments);
}
add_to_wishlist();
add_cart();
?>
<script type="text/javascript">
    function post_comment() {
        const commentBox = document.querySelector('#comment-box');
        if (commentBox.value === '')
            return false;
    }
</script>
<div class="container-fluid" style="background-color: grey;">
    <div class="container row bg-white mx-auto px-0">
        <div class="col-3 px-0">
            <?php include './components/aside-menu.php'; ?>
        </div>
        <div class="container col-9 row d-flex flex-column gap-5 py-5" style="max-width:100%; margin: 0 auto;">
            <!-- product's detail -->
            <div class="row align-items-stretch ps-0">
                <div class="col-6">
                    <img src=<?= $IMG_ROOT . $product['product_img'] ?> alt="" class="img-fluid" />
                </div>
                <div class="col-6 border-start ps-5">
                    <form action="" method="post" class="d-flex justify-content-start align-items-start flex-column gap-4">
                        <div class="form-group border-bottom">
                            <h3 class="mb-4"><?php echo $product['product_name'] ?></h3>
                            <hr style="width:30px; height:5px; border-radius:5px">
                            <h4 class="mb-4">
                                <span class="text-secondary">Price: </span>
                                <span><?= "$" . $product['price']  ?></span>
                            </h4>
                            <h4 class="mb-4">
                                <span class="text-secondary">In Stock: </span>
                                <?php
                                echo  $product['stock'] > 0 ?  "<span class='text-primary'>{$product['stock']}</span>" : "<span class='text-danger'>Out of stock!</span>";
                                ?>
                            </h4>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="product_id" value=<?= $product['product_id'] ?>>
                            <input type="hidden" name="product_img" value=<?= $product['product_img'] ?> />
                            <input type="hidden" name="product_name" class=" fs-4 fw-bold bg-transparent border-0" value="<?php echo $product['product_name'] ?>" />
                            <input type="hidden" name="price" id="price" class=" fs-2 fw-bold bg-transparent border-0" value=<?= $product['price'] ?> />
                            <div class="form-group d-flex align-items-center">
                                <label for="qty" class="text-secondary fw-bold">Quantity: </label>
                                <button type="button" class="btn btn-link px-2 text-danger" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input id="qty" min="1" name="quantity" value="1" type="number" class=" form-control-sm" style="max-width:50px; max-height:50px" />
                                <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center gap-3">
                            <button type="submit" class="add-cart-btn rounded border-0" name="add-to-cart"><i class="bi bi-cart3"></i> Add To Cart</button>
                            <button type="submit" class="add-cart-btn rounded border-0" name="add-to-wishlist"><i class="bi bi-heart"></i> Add To Wish List</button>
                        </div>
                    </form>
                </div>
                <!-- description -->
                <div class="col-xxl-12 accordion" id="accordionExample">
                    <div class="accordion-item border-0 bg-transparent">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="bg-transparent btn btn-dark border-0 text-dark fw-bold px-0 mb-2" id="show-desc--btn" onclick="hideShadow(this)" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span>Product's Description</span>
                                <span class="align-middle"><i class="bi bi-caret-down"></i></span>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show border-0" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body p-2 border rounded">
                                <?php echo $product['product_description'] ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- comment box -->
            <div class="container border rounded p-2 d-flex justify-content-start flex-column gap-3 shadow-sm">
                <h5 class="text-decoration-underline"><span class="pe-3">Comments</span><i class="bi bi-chat-left-text"></i></h5>
                <!-- posted comment list -->
                <div class="container d-flex flex-column gap-4 py-3" id="comment-list" style="max-height: 10rem;">
                    <?php
                    if (is_array($comments) && !empty($comments)) {
                        foreach ($comments as $cmt) {
                            extract($cmt)
                    ?>

                            <div class="d-flex justify-content-start gap-5 border-end-1">
                                <div class="">
                                    <img src=<?= $ROOT_AVATAR . $avatar ?> class="rounded-circle" style="max-width:40px">
                                </div>
                                <div class="w-100">
                                    <div class="rounded p-3" style="background-color: lightgrey;">
                                        <b class="pb-2 d-block"><?= $user_name ?></b>
                                        <p><?= $content ?></p>
                                        <p class="text-end mb-0" style="font-size:0.8rem"><?= "{$cmt_year}/{$cmt_mon}/{$cmt_day}" ?></p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else echo "<span class='text-muted'>No Comment...</span>"
                    ?>
                </div>
                <!-- comment input -->
                <div class="w-100">
                    <form action="" method="POST" onsubmit="return post_comment()">
                        <div class="d-flex justify-content-start align-items-center gap-2 p-2 w-100">
                            <label>
                                <img src=<?= !isset($_COOKIE['id']) ? $ROOT_AVATAR . 'default.jpg' : $ROOT_AVATAR . $userData['avatar'] ?> class="rounded-circle" style="max-width:50px">
                            </label>
                            <div class="border rounded-pill px-3 d-flex justify-content-center align-items-center gap-2 w-100">
                                <input type="text" class="form-control border-0 bg-transparent w-100" name="comment" id="comment-box" placeholder="Write comment about product ...">
                                <button type="submit" class="border-0 bg-transparent" name="post-comment"><i class="bi bi-chat-left-dots"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- related product -->
            <div class="container ps-0">
                <h4 class=" ps-0" style="color: var(--primary)">Related Products</h4>
                <?php
                $sql = "SELECT * FROM `product` WHERE `product`.`cate_id` = {$product['cate_id']}";
                render_product_slider($sql);

                ?>
            </div>
        </div>
    </div>
</div>
<?php
if (isset($_POST['post-comment'])) {
    if (isset($_COOKIE['id'])) {
        $content = $_POST['comment'];
        $user_id = $_COOKIE['id'];
        $product_id = $_GET['view'];
        $sql = "INSERT INTO `comments`(`content`, `user_id`, `product_id`,`comment_date`) 
                VALUES ('{$content}','{$user_id}','{$product_id}',CURRENT_TIME())";
        execute_query($sql);
        echo "<script>window.location = window.location.href</script>";
    } else echo "<script>alert(`You have to login to post comment`)</script>";
}
