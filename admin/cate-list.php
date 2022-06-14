<?php
$cateList = select_all_records("SELECT * FROM category");
?>
<div class="container bg-white py-5" style="">
    <h1 class="mb-5 text-center">Category List</h1>
    <table class="table my-0">
        <thead>
            <tr>
                <th>Category's ID</th>
                <th>Category's name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            if (empty($cateList))
                echo "<tr>
                        <td colspan='3'></td>
                    </tr>";
            else {
                foreach ($cateList as $category) :
            ?>
                    <tr>
                        <td scope="row"><?php echo $category['cate_id'] ?></td>
                        <td><?php echo $category['cate_name'] ?></td>
                        <td>
                            <a href=<?php echo "?page=cate-edit&id={$category['cate_id']}" ?> role="button " class="btn border border-2 border-dark">Edit</a>
                            <a href=<?php echo "./cate-del.php?id={$category['cate_id']}" ?> onclick="return confirm(`Are you sure?`)" role="button" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                endforeach;
            }
            ?>

        </tbody>
    </table>

</div>