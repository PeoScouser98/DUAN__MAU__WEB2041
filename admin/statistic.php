<?php
// lấy ra top 10 sản phẩm có doanh số bán ra cao nhất
function get_highestTurnover_byMonth($month)
{
    $sql = "SELECT product_name, price, SUM(quantity) as sold, SUM(amount) as turnover,MONTH(placed_on), YEAR(NOW()) as year FROM product
    INNER JOIN order_detail  ON  product.product_id=  order_detail.product_id
    INNER JOIN orders  ON  orders.order_id =  order_detail.order_id
    WHERE MONTH(placed_on) = $month AND YEAR(placed_on) = YEAR(NOW()) 
    GROUP BY order_detail.product_id
    ORDER BY order_detail.amount DESC";
    return select_all_records($sql);
}
?>

<div class="container py-5">
    <!-- bảnh doanh số bán ra theo từng tháng -->
    <h1 class="text-center text-uppercase mb-5">Turnover order by month</h1>
    <h1> </h1>
    <!-- month -->
    <div class="d-flex justify-content-start align-items-center gap-2 mb-5">
        <h4 class="me-5">Month:</h4>
        <?php
        for ($month = 1; $month <= 12; $month++) {
            echo "<a href='?page=statistic&month={$month}' class='btn border'>{$month}</a>";
        }
        ?>
    </div>
    <!-- data table -->
    <table class="table mb-5">
        <thead>
            <tr class="fs-5">
                <th>Product's name</th>
                <th>Price</th>
                <th>Sold</th>
                <th>Turnover</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $today = getdate();

            $month = isset($_GET['month']) ? $_GET['month'] : $today['mon'];
            $statistics = get_highestTurnover_byMonth($month);
            if (empty($statistics)) :
                echo '<tr>
                <td colspan="4" class="py-5"><h2 class="text-muted text-center">No Data</h2></td>
                </tr>';
            endif;
            $totalTurnover = 0;
            if ($statistics) :
                foreach ($statistics as $stat) : extract($stat) ?>
                    <tr>
                        <td><?php echo $product_name ?></td>
                        <td><?php echo  '$' . $price ?></td>
                        <td><?php echo  $sold ?></td>
                        <td><?php echo '$' .  $turnover ?></td>
                    </tr>
            <?php
                    $totalTurnover += $turnover;
                endforeach;
            endif;
            ?>
        </tbody>
        <tfoot>
            <tr class="fw-bold fs-5">
                <td colspan="3">Total Turnonver: </td>
                <td><?= '$' . $totalTurnover ?></td>
            </tr>
        </tfoot>
    </table>
    <!-- bar chart -->
    <h3 class="text-decoration-underline mt-5">Turnover bar chart</h3>
    <div id="myChart" class="my-3" style="height:25rem">
    </div>

</div>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Product', 'Net Sales($)'],
            <?php
            for ($i = 0; $i < count($statistics) - 1; $i++) {
                echo "['{$statistics[$i]['product_name']}',{$statistics[$i]['turnover']}],";
            }
            echo  "[
                '{$statistics[array_key_last($statistics)]['product_name']}',
                {$statistics[array_key_last($statistics)]['turnover']}
            ]";
            ?>
        ]);

        var options = {
            title: 'Turnover in this month'
        };

        var chart = new google.visualization.BarChart(document.getElementById('myChart'));
        chart.draw(data, options);
    }
</script>