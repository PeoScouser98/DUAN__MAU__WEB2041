<div class="container">
    <h1 class="mb-5">General Information</h1>
    <table class="table table-inverse table-responsive">
        <tr>
            <td class="text-secondary">User's Account</td>
            <td><?php echo $userData['user_id'] ?></td>
        </tr>
        <tr>
            <td class="text-secondary">User's name</td>
            <td><?php echo $userData['user_name'] ?></td>
        </tr>
        <tr>
            <td class="text-secondary">Email</td>
            <td><?php echo $userData['email'] ?></td>
        </tr>
        <tr>
            <td class="text-secondary">Address</td>
            <td><?php echo $userData['address'] ?></td>
        </tr>
        <tr>
            <td class="text-secondary">Phone number</td>
            <td><?php echo $userData['phone'] ?></td>
        </tr>
    </table>

</div>