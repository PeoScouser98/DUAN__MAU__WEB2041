<?php
function get_products()
{
    if (isset($_GET['groupby'])) {
        if ($_GET['groupby'] == 'sale')
            return get_products_onsale();
        elseif ($_GET['groupby'] == 'best-selling')
            return get_products_best_seller();
        else
            return get_products_by_cate();
    } elseif (isset($_GET['keyword']))
        return get_products_by_keyword();
    else
        return get_all_products();
}
