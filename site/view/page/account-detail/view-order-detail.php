<?php
if (isset($_GET['id'])) {
    $orderId = $_GET['id'];
    $sql = "SELECT * FROM order_detail INNER JOIN product ON order_detail.product_id = product.product_id WHERE order_id = {$orderId}";
    $order_details = select_all_records($sql);
}
?>
<div class="container bg-white p-5">
    <h1 class="mb-5">Order Details</h1>
    <table class="table" style="max-width: auto">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product's Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (is_array($order_details) && !empty($order_details)) {
                foreach ($order_details as $order) :
                    extract($order);
            ?>
                    <tr>
                        <td><?= $order_id ?></td>
                        <td><?= $product_name ?></td>
                        <td><?= '$' . $price ?></td>
                        <td><?= $quantity ?></td>
                        <td><?= '$' . $amount ?></td>
                    </tr>
            <?php
                endforeach;
            } else
                echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>There is no order!</td></tr>";
            ?>
        </tbody>
    </table>
    <button class="btn btn-dark" onclick="history.go(-1)">Back To Order List</button>
</div>