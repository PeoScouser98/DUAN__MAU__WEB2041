<?php
$data = get_products();
if (isset($_SESSION['cart']) && isset($_POST['add-to-cart'])) add_cart($userData);





?>
<div>
    <?php include './site/view/components/banner.php' ?>
</div>
<div class="container-fluid px-0" style="background-color: grey;">
    <div class="container row px-0 bg-white mx-auto">
        <!-- fixed aside menu -->
        <div class="col-3 px-0">
            <?php include './site/view/components/aside-menu.php'; ?>
        </div>
        <!-- product list -->
        <div class="container col-9 mx-auto px-0 py-5" style="max-width:100%">
            <div class="container d-flex justify-content-between align-items-center">
                <div>
                    <h3 id="cate"><?= $data['label'] ?></h3>
                </div>
                <div class="px-0 d-flex justify-content-end">
                    <select class="form-select w-auto" onchange="window.location = this.value">
                        <?php if (isset($_GET['groupby'])) : ?>
                            <option value=<?php echo "?page=products&groupby={$_GET['groupby']}&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&groupby={$_GET['groupby']}&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                        <?php if (isset($_GET['keyword'])) :  ?>
                            <option value=<?php echo "?page=products&keyword={$_GET['keyword']}&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&keyword={$_GET['keyword']}&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                        <?php if (!isset($_GET['groupby']) && !isset($_GET['keyword'])) :  ?>
                            <option value=<?php echo "?page=products&sort=asc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'asc' ? "selected" : "" ?>>Ascending Price</option>
                            <option value=<?php echo "?page=products&sort=desc#cate" ?> <?php echo isset($_GET['sort']) && $_GET['sort'] == 'desc' ? "selected" : "" ?>>Descending Price</option>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- show products -->
            <div class="container row gap-xxl-4 gap-lg-3 my-5 mx-auto" style="max-width:100%;">
                <?php
                foreach ($data['products'] as $item) : extract($item);
                ?>
                    <!-- render các sản phẩm được chọn trong danh mục  -->
                    <div class="card col-4 postion-relative px-0 rounded-3 d-flex justify-content-between align-items-center flex-column" style="max-width:16rem;height:auto">
                        <?php if ($discount > 0) : ?>
                            <span class='position-absolute text-white fw-bold bg-danger px-2 py-1 top-0 end-0'><?= 'Discount ' . $discount . '%' ?></span>
                        <?php endif; ?>
                        <div>
                            <a href=<?= "?page=product-detail&view={$product_id}" ?>>
                                <img class="card-img-top rounded-3 product-img img-fluid" src=<?php echo $IMG_ROOT . $product_img ?> alt="product's image" style="width:100%;height:150px" />
                            </a>
                        </div>
                        <div class="d-flex justify-content-between flex-column gap-2 p-3" style="width:100%">
                            <div>
                                <div class="overflow-auto product-name" style="width:100%">
                                    <h6 class="text-secondary text-nowrap"><?= $product_name ?></h6>
                                </div>
                                <h6 class="fw-bold text-secondary">In Stock: <span class="text-primary"><?= $stock ?></span></h6>
                                <?php if ($discount == 0) : ?>
                                    <h4 style="font-size:18px"><?= "$" . $price ?></h4>
                                <?php endif; ?>
                                <?php if ($discount > 0) : ?>
                                    <div class="d-flex align-items-center gap-2">
                                        <h5 class="text-decoration-line-through text-muted"><?= "$" . $price ?></h5>
                                        <h4 class="text-danger"><?= "$" . $price * (1 - $discount / 100) ?></h4>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <form action="" method="POST" class="w-100">
                                <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                                <input type="hidden" name="product_img" value="<?php echo $product_img ?>">
                                <input type="hidden" name="product_name" value="<?php echo $product_name ?>">
                                <input type="hidden" name="price" value="<?php echo $price * (1 - $discount / 100) ?>">
                                <div class="d-flex mb-2 justify-content-between align-items-center">
                                    <div class="d-flex mb-2">
                                        <button type="button" class="btn btn-link px-2 text-danger" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="fas fa-minus"></i></button>
                                        <input min="1" name="quantity" value=1 type="number" class="form-control form-control-sm" style="width:4rem" />
                                        <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="fas fa-plus"></i></button>
                                    </div>
                                    <button type="submit" class="add-wish-list__btn border-0 bg-transparent fs-4 fw-bold" name="add-to-wishlist"><i class="bi bi-heart"></i></button>
                                </div>
                                <button type="submit" name="add-to-cart" class="add-cart-btn btn w-100 d-block border-0" style="max-width: 100%; margin: 0 auto">
                                    <span class="fs-5"><i class="bi bi-cart3"></i></span>
                                    <span class="ps-2">Add To Cart</span>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php
                endforeach;
                ?>
                <div class="container pagination d-flex justify-content-center align-items-center gap-2 mt-5">
                    <?php
                    for ($i = 1; $i <= $data['pagination']['lastIndex']; $i++) {
                        if (isset($_GET['groupby']))
                            echo "<a href='?page=products&groupby={$_GET['groupby']}&tabindex={$i}#cate' class='btn border-dark pagination-button'>{$i}</a>";
                        else
                            echo "<a href='?page=products&tabindex={$i}#cate' class='btn border-dark pagination-button'>{$i}</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>