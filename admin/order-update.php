<?php
// check trạng thái đơn hàng đã hủy hay chưa ?
function isntCanceled()
{
    if (isset($_POST['orderId']) && is_array($_POST['orderId'])) {
        foreach ($_POST['orderId'] as $id) :
            $sql = "SELECT status_id FROM orders WHERE order_id  = '{$id}'";
            $status = select_single_record($sql);
        endforeach;
        $isntCanceled = false;
        foreach ($status as $stt) {
            if ($stt == 1 || $stt == 2)
                $isntCanceled = true;
        }
        return  $isntCanceled;
    }
}
// 
if (isset($_POST['orderId']) && isset($_POST['mark-done'])) {
    if (is_array($_POST['orderId']) && isntCanceled()) {
        foreach ($_POST['orderId'] as $orderId) :
            execute_query("UPDATE orders SET status_id = 2 WHERE order_id = '{$orderId}'");
        endforeach;
        echo "<script>alert(`This order is completed!`) </script>";
        echo "<script>history.go(-1)</script>";
    } else {
        echo "<script>setTimeout(history.go(-1),5000) </script>";
        echo "<script>alert(`Failed!`) </script>";
    }
}
// nếu đơn hàng về trạng thái hủy sẽ hoàn lại số lượng sản phẩm về stock
if (isset($_POST['orderId']) && isset($_POST['cancel'])) {
    if (is_array($_POST['orderId']) && isntCanceled()) {
        for ($i = 0; $i < count($_POST['orderId']); $i++) {
            execute_query("UPDATE orders SET status_id = 3 WHERE order_id = '{$_POST['orderId'][$i]}'");
            execute_query("UPDATE product SET stock = stock+ {$_POST['qty'][$i]} WHERE product_id = {$_POST['product_id'][$i]}");
        }
        echo "<script>alert(`This order is Canceled!`) </script>";
        echo "<script>history.go(-1)</script>";
    } else {
        echo "<script>alert(`Failed!`)</script>";
    }
}
