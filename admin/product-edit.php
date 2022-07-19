<?php
$error = [];
$sql = "SELECT * FROM category";
$categories = select_all_records($sql);
if (isset($_GET['id'])) {
    $product = select_single_record("SELECT * FROM product  WHERE product_id = '{$_GET['id']}'");
    extract($product);
}
?>
<div class="bg-white d-flex flex-column justify-content-center align-items-center gap-5 py-5" style="max-width:1200px; margin: 0 auto">
    <h1 class="text-center text-secondary">Edit Product</h1>
    <form action="" method="POST" enctype="multipart/form-data" style="width: 40em">
        <div class="mb-3">
            <label for="cate" class="form-label">Product's category</label>
            <select class="form-control" name="cate" id="cate">
                <option value="">-- Select --</option>
                <?php foreach ($categories as $cate) : ?>
                    <option value=<?= $cate['cate_id'] ?> <?php if ($cate_id == $cate['cate_id']) echo 'selected' ?>>
                        <?= $cate['cate_name'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <small id="helpId" class="form-text text-danger fw-bold">
                <?php check_empty("cate", "prdouct's category"); ?>
            </small>
        </div>
        <!-- product's name -->
        <div class="mb-3 ">
            <label for="product-name" class="form-label">Product's name</label>
            <input type="text" class="form-control" name="product_name" id="product-name" aria-describedby="helpId" value="<?php echo $product_name ?>">
            <small id="helpId" class="form-text text-danger fw-bold">
                <?php check_empty("product_name", "product's name"); ?>
            </small>
        </div>
        <!-- price -->
        <div class="mb-3">
            <label for="price" class="form-label">Product's price</label>
            <input type="number" min=0 class="form-control" name="price" id="price" aria-describedby="helpId" value=<?= $price ?>>
            <small id="helpId" class="form-text text-danger fw-bold">
                <?php check_empty("price", "price"); ?>
            </small>
        </div>
        <!-- image -->
        <div class="mb-3">
            <label for="image" class="form-label">Product's Image</label>
            <input type="file" class="form-control" name="product_img" id="image" value=<?= $product_img ?> aria-describedby="fileHelpId">
            <small id="fileHelpId" class="form-text fw-bold text-danger">
                <?php check_image('product_img', 'submit'); ?>
            </small>
        </div>
        <!-- discount -->
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" min=0 class="form-control" name="discount" id="" value=0 aria-describedby="helpId" value=<?= $discount ?>>
        </div>
        <!-- product's description -->
        <div class="mb-3 ">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control d-block w-100" value="<?php echo $product_description ?>"></textarea>
            <small id="helpId" class="form-text text-danger fw-bold">
                <?php check_empty("description", "description"); ?>
            </small>
        </div>
        <!-- submit -->
        <div class="mb-3">
            <input type="submit" class="btn bg-dark text-white vertical-align-top" rows="10" name="submit" value="Edit Product">
        </div>

    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    if (empty($error)) {
        $cateID = $_POST['cate'];
        $productName = $_POST["product_name"];
        $price = $_POST["price"];
        $path = upload_file('../assets/img/products/', 'product_img');
        $discount = $_POST['discount'];
        $description = $_POST['description'];
        $sql = "UPDATE product SET cate_id='{$cateID}',
                                    product_name='{$productName}',
                                    price='{$price}',
                                    product_img='{$path}',
                                    discount='{$discount}',
                                    product_description='{$description}'
                WHERE product_id = '{$_GET['id']}'";
        execute_query($sql);
        echo "<script>alert(`Edit product successfully!`)</script>";
        echo "<script>window.location = '?page=product-list'</script>";
    } else {
        echo "<script>alert(`Failed!`)</script>";
    }
}
