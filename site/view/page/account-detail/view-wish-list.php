<?php

$wishList = get_wishList_items($userData);
add_cart();
?>
<style>
    .wish-list-container::-webkit-scrollbar {
        width: 0.5rem;
    }

    .wish-list-container::-webkit-scrollbar-thumb {
        background-color: lightgray;
        border-radius: 10px;
    }
</style>
<div class="container">
    <h1 class="mb-5">My Wish List</h1>
    <div class="mb-3">
        <span class="text-end">Items: <span><?= count($wishList) ?></span></span>
    </div>
    <div class="overflow-auto wish-list-container pe-3" style="max-height:30rem">
        <table class="table align-middle">
            <thead class="position-sticky top-0 text-dark border-0" style="background-color: lightgrey;">
                <tr>
                    <th scope="col">-</th>
                    <th scope="col">Image</th>
                    <th scope="col">Product's name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Stock</th>
                    <th scope="col">-</th>
                </tr>
            </thead>
            <tbody class="">
                <?php
                if (is_array($wishList) && !is_null($wishList)) :
                    foreach ($wishList as $item) : ?>
                        <tr class="vertical-middle">
                            <td scope="col"><a href=<?php echo "./controllers/wish-list.php?delid={$item['product_id']}" ?> class="text-decoration-none text-muted"><i class="bi bi-trash"></i></a></td>
                            <td scope="col"><img src=<?php echo $IMG_ROOT . $item['product_img'] ?> alt="" class="img-fluid" style="max-width: 80px; height:80px;object-fit:contain"></td>
                            <td scope="col"><?= $item['product_name'] ?></td>
                            <td scope="col"><?= '$' . $item['price'] ?></td>
                            <td scope="col"><?= $item['discount'] ?></td>
                            <td scope="col"><?= $item['stock'] ?></td>
                            <td scope="col">
                                <form action="./site/controllers/cart-list.php" method="POST">
                                    <input type="hidden" name="product_id" value=<?php echo $item['product_id'] ?>>
                                    <input type="hidden" name="product_name" value=<?php echo $item['product_name'] ?>>
                                    <input type="hidden" name="price" value=<?php echo $item['price'] ?>>
                                    <input type="hidden" name="product_img" value=<?php echo $item['product_img'] ?>>
                                    <input type="hidden" name="quantity" value=1 min=1 ?>
                                    <button type="submit" class="add-cart-btn rounded border-0" name="add-to-cart"><i class="bi bi-cart3"></i> Add To Cart</button>
                                </form>
                            </td>
                        </tr>
                <?php
                    endforeach;
                endif;
                ?>
            </tbody>
        </table>
    </div>
</div>