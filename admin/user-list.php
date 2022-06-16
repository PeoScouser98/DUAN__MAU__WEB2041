<?php
$sql = "SELECT * FROM users
INNER JOIN user_role ON users.role_id = user_role.role_id
WHERE user_id NOT IN (SELECT user_id FROM users WHERE role_id= 1 )";
$userList = select_all_records($sql);
?>
<style>
    td {
        max-width: 200px;
    }
</style>
<div class="container bg-white py-5">
    <h1 class="text-center mb-5">User List</h1>
    <table class="table align-center">
        <thead>
            <tr>
                <th class="d-none">ID</th>
                <th>Avatar</th>
                <th>User's name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($userList) && !empty($userList)) {
                foreach ($userList as $user) :
            ?>
                    <tr>
                        <td><img src=<?php echo $ROOT_AVATAR_ADMIN . $user['avatar'] ?> class="rounded-circle" style="max-width:60px; height:60px"></td>
                        <td class="d-none"><?= $user['user_id'] ?></td>
                        <td><?= $user['user_name'] ?></td>
                        <td><?= $user['phone'] ?></td>
                        <td class="text-wrap"><?= $user['email'] ?></td>
                        <td><?= $user['address'] ?></td>
                        <td><?= ucfirst($user['role_name']) ?></td>
                        <td>
                            <a href=<?php echo "?page=user-edit&id={$user['user_id']}" ?> class="btn border-2 border-dark">Edit</a>
                            <a href=<?php echo "user-del.php?id={$user['user_id']}" ?> class="btn btn-danger" onclick="return confirm(`Are you sure ?`) ">Delete</a>
                        </td>
                    </tr>
            <?php
                endforeach;
            } else
                echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>There is no products</td></tr>";
            ?>
        </tbody>
    </table>
</div>