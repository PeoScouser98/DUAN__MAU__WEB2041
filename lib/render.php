<?php
// render product theo slider
function render_product_slider($sql)
{
    global $IMG_ROOT;
?>
    <div class="owl-carousel owl-theme w-100" style="height:auto; padding: 20px 20px 20px 0">
        <?php
        $products = select_all_records($sql);
        foreach ($products as $item) :
            extract($item);
        ?>
            <!-- render các sản phẩm được chọn trong danh mục  -->
            <div class="position-relative px-0 border d-flex justify-content-between flex-column align-items-center rounded-3 me-3 bg-white" style=" max-width:20rem;height:100%">
                <?php if ($discount > 0) : ?>
                    <span class="position-absolute top-0 end-0 text-white fw-bold bg-danger px-2 py-1"><?= 'Discount ' . $discount . '%' ?></span>
                <?php endif; ?>
                <div>
                    <a href=<?= "?page=product-detail&view={$product_id}" ?>>
                        <img class="card-img-top rounded-3 product-img img-fluid" src=<?php echo $IMG_ROOT . $product_img ?> alt="product's image" style="height:150px" />
                    </a>
                </div>
                <div class="d-flex justify-content-between flex-column gap-2 p-3" style="width:100%">
                    <div>
                        <div class="product-name overflow-auto">
                            <h6 class="fw-bold text-secondary text-nowrap"><?= $product_name ?></h6>
                        </div>
                        <h6 class="fw-bold text-secondary">In Stock: <span class="text-success"><?= $stock ?></span></h6>
                        <?php if ($discount == 0) : ?>
                            <h4 class=" fw-semibold"><?= "$" . $price ?></h4>
                        <?php endif; ?>
                        <?php if ($discount > 0) : ?>
                            <div class="d-flex align-items-center gap-2">
                                <h5 class="fw-bold text-decoration-line-through text-muted"><?= "$" . $price ?></h5>
                                <h4 class="fw-bold text-danger"><?= "$" . $price * (1 - $discount / 100) ?></h4>
                            </div>
                        <?php endif; ?>
                    </div>
                    <form action="" method="POST" class="w-100">
                        <input type="hidden" name="product_id" value="<?php echo $product_id ?>">
                        <input type="hidden" name="product_img" value="<?php echo $product_img ?>">
                        <input type="hidden" name="product_name " value="<?php echo $product_name ?>">
                        <input type="hidden" name="price" value="<?php echo $item['price'] ?>">
                        <div class="d-flex mb-2 justify-content-between align-items-center">
                            <div class="d-flex mb-2">
                                <button type="button" class="btn btn-link px-2 text-danger" onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i class="fas fa-minus"></i></button>
                                <input id="form1" min="1" name="quantity" value="1" type="number" class="form-control form-control-sm" style="width:4rem" />
                                <button type="button" class="btn btn-link px-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i class="fas fa-plus"></i></button>
                            </div>
                            <button type="submit" class="border-0 bg-transparent fs-4 fw-bold" name="add-to-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <button type="submit" name="add-to-cart" class="add-cart-btn btn bg-dark text-white w-100 d-block border-0" onclick="showMessage()" style="max-width: 100%; margin: 0 auto">
                            <i class="bi bi-cart3"></i>
                            <span>Add To Cart</span>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php
}



// render product theo card list 
function render_product_cards($data, $imgdir, $pagination)
{
?>
    <div class="container row gap-xxl-4 gap-lg-3 my-5 mx-auto" style="max-width:100%;">
        <?php
        foreach ($data as $item) : extract($item);
        ?>
            <!-- render các sản phẩm được chọn trong danh mục  -->
            <div class="card col-4 postion-relative px-0 rounded-3" style="max-width:16rem;height:auto">
                <?php if ($discount > 0) : ?>
                    <span class='position-absolute text-white fw-bold bg-danger px-2 py-1 top-0 end-0'><?= 'Discount ' . $discount . '%' ?></span>
                <?php endif; ?>
                <div>
                    <a href=<?= "?page=product-detail&view={$product_id}" ?>>
                        <img class="card-img-top rounded-3 product-img img-fluid" src=<?php echo $imgdir . $product_img ?> alt="product's image" style="width:100%;height:150px" />
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
                            <button type="submit" class="border-0 bg-transparent fs-4 fw-bold" name="add-to-wishlist"><i class="bi bi-heart"></i></button>
                        </div>
                        <button type="submit" name="add-to-cart" class="add-cart-btn btn bg-dark text-white w-100 d-block border-0" onclick="showMessage()" style="max-width: 100%; margin: 0 auto">
                            <i class="bi bi-cart3"></i>
                            <span>Add To Cart</span>
                        </button>
                    </form>
                </div>
            </div>
        <?php
        endforeach;
        ?>
        <div class="container pagination d-flex justify-content-center align-items-center gap-2 mt-5">
            <?php
            for ($i = 1; $i <= $pagination['lastIndex']; $i++) {
                if (isset($_GET['groupby']))
                    echo "<a href='?page=products&groupby={$_GET['groupby']}&tabindex={$i}#cate' class='btn btn-dark'>{$i}</a>";
                else
                    echo "<a href='?page=products&tabindex={$i}#cate' class='btn btn-dark'>{$i}</a>";
            }
            ?>
        </div>
    </div>
<?php
}
