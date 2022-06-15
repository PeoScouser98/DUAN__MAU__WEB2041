<?php
$sql = "SELECT * FROM `orders` 
        INNER JOIN `order_status` ON `orders`.`status_id` = `order_status`.`status_id` 
        WHERE user_id =  '{$userData['user_id']}'
        ORDER BY orders.order_id DESC";
$orderList = select_all_records($sql);

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
    <h1 class="mb-5">My Orders</h1>
    <div class="mb-3">
        <span class="text-end">Orders: <span><?= count($orderList) ?></span></span>
    </div>
    <div class="overflow-auto wish-list-container pe-3" style="max-height:30rem">
        <table class="table align-middle">
            <thead class="position-sticky top-0" style="background-color:lightgrey ;">
                <tr>
                    <th>Order ID</th>
                    <th>Total Amount</th>
                    <th>Placed On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($orderList) && !is_null($orderList)) {
                    foreach ($orderList as $order) :
                        extract($order);
                ?>
                        <tr>
                            <td><?= $order_id ?></td>
                            <td><?= '$' . $total_amount ?></td>
                            <td><?= $placed_on ?></td>
                            <td>
                                <input disabled type="text" class="order-status fw-bold bg-transparent border-0" value=<?= ucfirst($status_name) ?>>
                            </td>
                            <td>
                                <a href=<?php echo "?page=profile&act=view-order-detail&id={$order_id}" ?> class="btn border-2 border-dark">View Detail</a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                } else
                    echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>There is no order!</td></tr>";
                ?>
            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    const orderStatus = document.querySelectorAll('.order-status');
    for (const stt of orderStatus) {
        if (stt.value == 'Pending')
            stt.classList.add('text-warning');
        else if (stt.value == 'Completed')
            stt.classList.add('text-success');
        else
            stt.classList.add('text-danger');
    }
</script>