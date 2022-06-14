<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM category WHERE cate_id = {$id}";
    $category = select_single_record($sql);
}
$error = [];

?>
<div class="bg-white d-flex flex-column justify-content-center align-items-center gap-5 py-5" style="max-width:1200px; margin: 0 auto">
    <h1 class="text-center text-secondary">Add New Category</h1>
    <form action="" method="post" style="width: 40em">
        <!-- cate id -->
        <div class="mb-3">
            <label for="cate-id" class="form-label">Category's ID</label>
            <input type="number" class="form-control" name="cate_id" id="cate-id" aria-describedby="helpId" value=<?php echo $category['cate_id'] ?> placeholder="Category's id" disabled>
        </div>
        <!-- cate name -->
        <div class="mb-3">
            <label for="cate-name" class="form-label">Category's name</label>
            <input type="text" class="form-control" name="cate_name" id="cate-name" aria-describedby="helpId" value=<?php echo $category['cate_name'] ?>>
            <small id="helpId" class="form-text text-danger fw-bold">
                <?php
                check_empty("cate_name", "category's name");
                ?>
            </small>
        </div>
        <!-- cate icon -->
        <div class="mb-3">
            <label for="cate-icon" class="form-label">Category's Icon</label>
            <input type="text" class="form-control" name="cate_icon" id="cate-icon" aria-describedby="helpId" placeholder="">
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("cate_icon", "category's icon");
                ?>
            </small>
        </div>
        <!-- submit -->
        <div class="mb-3">
            <input type="submit" class="form-control btn bg-dark text-white w-auto d-block mx-auto" name="submit" value="Edit Product's category">
        </div>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
    if (empty($error)) {
        $cate_name = $_POST["cate_name"];
        $cate_icon = $_POST["cate_icon"];
        $sql = "UPDATE `category` SET  `cate_name` = '{$cate_name}', `cate_icon` = '{$cate_icon}' WHERE `cate_id` = '{$category['cate_id']}'";
        execute_query($sql);
        echo "<script>history.go(-2)</script>";
    }
}
