<?php
$sql = "SELECT * FROM comments INNER JOIN users ON comments.user_id = users.user_id";
$comments = select_all_records($sql);
?>
<div class="container bg-white py-5">
    <h1 class="text-center mb-5">Comment List</h1>
    <form action="?page=comment-del" method="POST" onsubmit="return confirm(`Do you want to delete all of these comments?`)">
        <table class="table">
            <thead>
                <tr>
                    <th>-</th>
                    <th>User's name</th>
                    <th>Content</th>
                    <th>Comment Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($comments)) {
                    foreach ($comments as $cmt) : extract($cmt)
                ?>
                        <tr>
                            <td><input type="checkbox" class="check-box" name="delId[]" value=<?= $comment_id ?>></td>
                            <td><?= $user_name ?></td>
                            <td><?= $content ?></td>
                            <td><?= $comment_date ?></td>
                            <td>
                                <a href=<?= "?page=comment-del&delId={$comment_id}" ?> class="btn btn-danger" onclick="return confirm('Delete this comment ?')">Delete</a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                } else
                    echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>There is no comment !</td></tr>";
                ?>
            </tbody>
        </table>
        <div class="form-group">
            <button type="button" class="btn bg-tranparent border border-dark" onclick="selectAll()">Select All</button>
            <button type="button" class="btn btn-dark" onclick="deselectAll()">Deselect All</button>
            <button type="submit" name="delete-all" class="btn btn-danger">Delete All</button>
        </div>
    </form>
</div>
<script>
    const checkboxes = document.querySelectorAll('.check-box');

    function selectAll() {
        for (const box of checkboxes) {
            box.checked = true
        }
    }

    function deselectAll() {
        for (const box of checkboxes) {
            box.checked = false
        }
    }
</script>