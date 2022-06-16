<?php
$orderStatus = select_all_records("SELECT * FROM order_status");
// lọc theo trạng thái
if (isset($_GET['filterby']) && is_numeric($_GET['filterby'])) {
    $pagination = paginate_page("SELECT COUNT(`order_id`) FROM `orders` WHERE orders.status_id = {$_GET['filterby']}", 10);
    extract($pagination);
    $orders = select_all_records("SELECT orders.order_id,
                                        product.product_id,
                                        product.product_name,
                                        quantity,
                                        user_id,
                                        total_amount,
                                        placed_on,
                                        order_status.status_name FROM orders 
                                        INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                                        INNER JOIN order_status ON orders.status_id = order_status.status_id 
                                        INNER JOIN product ON product.product_id = order_detail.product_id 
                                        WHERE orders.status_id = {$_GET['filterby']}
                                        GROUP BY orders.placed_on
                                        ORDER BY MONTH(placed_on) DESC, DAY(placed_on) DESC
                                        LIMIT {$startIndex}, {$qty}");
}
// lấy tất cả
else {
    $pagination = paginate_page("SELECT COUNT(`order_id`) FROM `orders`", 10);
    extract($pagination);
    $orders = select_all_records("SELECT orders.order_id,
                                        product.product_id,
                                        product.product_name,
                                        quantity,
                                        user_id,
                                        total_amount,
                                        placed_on,
                                        order_status.status_name
                                        FROM orders 
                                        INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                                        INNER JOIN order_status ON orders.status_id = order_status.status_id 
                                        INNER JOIN product ON product.product_id = order_detail.product_id 
                                        GROUP BY orders.placed_on
                                        ORDER BY MONTH(placed_on) DESC, DAY(placed_on) DESC
                                        LIMIT {$startIndex}, {$qty}");
}
if (isset($_POST['search'])) {
    $pagination = paginate_page("SELECT COUNT(`order_id`) FROM `orders` WHERE orders.order_id = '{$_POST['order_id']}'", 10);
    extract($pagination);
    $orders = select_all_records("SELECT orders.order_id,
                                        product.product_id,
                                        product.product_name,
                                        quantity,
                                        user_id,
                                        total_amount,
                                        placed_on,
                                        order_status.status_name FROM orders 
                                        INNER JOIN order_detail ON orders.order_id = order_detail.order_id
                                        INNER JOIN order_status ON orders.status_id = order_status.status_id 
                                        INNER JOIN product ON product.product_id = order_detail.product_id 
                                        WHERE orders.order_id = {$_POST['order_id']}
                                        GROUP BY orders.placed_on
                                        ORDER BY MONTH(placed_on) DESC, DAY(placed_on) DESC
                                        LIMIT {$startIndex}, {$qty}");
}

?>
<style>
    td {
        max-width: 200px;
    }
</style>

<div class="container py-5">
    <h1 class="text-center mt-3 mb-5">Order List</h1>
    <div class="d-flex justify-content-between align-items-center mb-5">
        <!-- filter order -->
        <div class="">
            <select class="form-select rounded-pill" name="" onchange="window.location = this.value">
                <option value="?page=order-list">All</option>
                <?php foreach ($orderStatus as $stt) :  extract($stt) ?>
                    <option value=<?php echo "?page=order-list&filterby={$status_id}" ?> <?php echo isset($_GET['filterby']) && $status_id == $_GET['filterby'] ? "selected" : "" ?>><?= ucfirst($status_name)  ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <!-- search order -->
        <div class="">
            <form action="" method="POST">
                <div class="input-group rounded-pill d-flex align-items-center gap-2 px-2 border border-1 border-dark">
                    <input type="number" min=1 name="order_id" class="form-control rounded-pill border-0 bg-transparent" id="search-input" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" name="search" class="border-0" style="background-color: transparent"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>

    <form action="?page=order-update" method="POST" onsubmit="return check()">
        <table class="table">
            <thead>
                <tr>
                    <th style="vertical-align:middle;">-</th>
                    <th>Order ID</th>
                    <th>Belongs To</th>
                    <th>Total Amount</th>
                    <th>Placed On</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($orders) && !empty($orders)) {
                    foreach ($orders as $order) :
                        extract($order);
                ?>
                        <tr>
                            <td><input type="checkbox" class="checkbox" name="orderId[]" value=<?= $order_id ?>></td>
                            <td><?= $order_id ?></td>
                            <td><?= $user_id ?></td>
                            <input type="hidden" name="product_id" value=<?= $product_id ?>>
                            <input type="hidden" name="qty" value=<?= $quantity ?>>
                            <td><?= '$' . $total_amount ?></td>
                            <td><?= $placed_on ?></td>
                            <td>
                                <input disabled type="text" class="order-status fw-bold bg-transparent border-0" value=<?= ucfirst($status_name) ?>>
                            </td>
                            <td>
                                <a href=<?php echo "?page=order-detail&id={$order_id}" ?> class="btn border-2 border-dark">View Detail</a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                } else
                    echo "<tr><td colspan='7' class='text-center text-danger fw-bold'>No Result!</td></tr>";
                ?>
            </tbody>
        </table>
        <div class="form-group my-3">
            <button type="submit" class="btn btn-dark" name="mark-done">Mark As Done</button>
            <button type="submit" name="cancel" class="btn btn-danger" onclick="return confirmCancel()">Cancel</button>
        </div>
    </form>
    <div class="d-flex justify-content-center align-items-center gap-2">
        <?php
        for ($i = 1; $i <= $lastIndex; $i++) {
            echo "<a href='?page=order-list&tabindex={$i}' role='button' class='btn btn-dark'>{$i}</a>";
        }
        ?>
    </div>
</div>
<script type="text/javascript">
    const orderStatus = document.querySelectorAll('.order-status');
    console.log(orderStatus);
    for (const stt of orderStatus) {
        if (stt.value == "Canceled") {
            const checkbox = stt.parentElement.parentElement.querySelector('.checkbox');
            checkbox.setAttribute('disabled', '');
            stt.parentElement.parentElement.style.backgroundColor = "lightgray";
            stt.classList.add('text-danger');
        }
        if (stt.value == "Pending") {
            const checkbox = stt.parentElement.parentElement.querySelector('.checkbox');
            stt.classList.add('text-warning');
        }
        if (stt.value == "Completed") {
            const checkbox = stt.parentElement.parentElement.querySelector('.checkbox');
            checkbox.setAttribute('disabled', '');
            stt.parentElement.parentElement.style.backgroundColor = "lightgray";
            stt.classList.add('text-success');
        }
    }

    const checkbox = document.querySelectorAll('.checkbox');

    function confirmCancel() {
        let checked = 0
        for (const box of checkbox) {
            if (box.checked == true)
                checked++;
        }
        if (checked != 0)
            return confirm('Are you sure?');
    }

    function check() {
        let checked = 0
        for (const box of checkbox) {
            if (box.checked == true) {
                checked++;
                console.log(checked);
            }
        }
        return checked != 0 ? true : false;
    }
</script>