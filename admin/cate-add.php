<?php
$error = [];
?>
<div class="bg-white d-flex flex-column justify-content-center align-items-center gap-5 py-5" style="max-width:1200px; margin: 0 auto">
    <h1 class="text-center text-secondary">Add New Category</h1>
    <form action="" method="post" style="width: 40em">
        <!-- cate id -->
        <div class="mb-3">
            <label for="cate-id" class="form-label">Category's ID</label>
            <input type="text" class="form-control" name="cate_id" id="cate-id" aria-describedby="helpId" placeholder="Auto Increment" disabled>
        </div>
        <!-- cate name -->
        <div class="mb-3">
            <label for="" class="form-label">Category's name</label>
            <input type="text" class="form-control" name="cate_name" id="" aria-describedby="helpId" placeholder="">
            <small class="form-text text-danger fw-bold">
                <?php
                check_empty("cate_name", "category's name");
                ?>
            </small>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Category's Icon</label>
            <input type="text" class="form-control" name="cate_icon" id="" aria-describedby="helpId" placeholder="">
        </div>
        <!-- submit -->
        <div class="mb-3">
            <input type="submit" class="form-control btn bg-dark text-white w-auto d-block mx-auto" name="submit" value="Add New Category">
        </div>
    </form>
</div>

<?php
if (isset($_POST['submit'])) :
    if (empty($error)) {
        $cateName = $_POST["cate_name"];
        $cateIcon = $_POST["cate_icon"];
        $cate_name = select_all_records("SELECT cate_name FROM category");
        $isExisting = false;
        foreach ($cate_name as $item) :
            if (strStandardize($cateName) == strStandardize($item['cate_name'])) :
                $isExisting = true;
                echo "<script>alert(`This category existed!`)</script>";
                break;
            endif;
        endforeach;
        if ($isExisting == false) {
            $sql = "INSERT INTO category (cate_name,cate_icon) VALUES ('{$cateName}','{$cateIcon}')";
            execute_query($sql);
            echo "<script>alert(`Add a new category successfully!`)</script>";
            echo "<script>window.location.reload()</script>";
        }
    } else
        echo "<script>alert(`Failed!`)</script>";
endif;
