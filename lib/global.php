<?php
$ROOT_AVATAR_ADMIN = "../assets/img/avatar/";
$IMG_ROOT_ADMIN = '../assets/img/products/';
$ROOT_AVATAR = "/ecommerce/assets/img/avatar/";
$IMG_ROOT = '/ecommerce/assets/img/products/';
// chuẩn hóa chuỗi
function strStandardize($string)
{
    $string = trim($string);
    while (strpos($string, "  ")) {
        $string = str_replace("  ", " ", $string);
    }
    $subString = explode(" ", $string);
    $result = "";
    for ($i = 0; $i < count($subString); $i++) {
        $result = $result . " " . strtolower($subString[$i]);
    }
    return $result;
}


// upload file ảnh
function upload_file($directory, $inputFileName)
{
    if (isset($_FILES)) {
        print_r($_FILES);
        $file_name = $_FILES[$inputFileName]['full_path'];
        $path = $directory . $file_name;
        move_uploaded_file($_FILES[$inputFileName]['tmp_name'], $path);
        return $file_name;
    }
}
// phân trang
function paginate_page($qty_sql, $NO_ITEMS_EACH_PAGE)
{
    $pageIndex = isset($_GET['tabindex']) ? $_GET['tabindex'] : 1;
    $numOfItems = select_one_value($qty_sql); // tổng số sản phẩm
    $lastIndex = ceil($numOfItems / $NO_ITEMS_EACH_PAGE); // lastIndex = tổng số trang
    $startIndex = ($pageIndex - 1) * $NO_ITEMS_EACH_PAGE;
    return   array(
        "qty" => $NO_ITEMS_EACH_PAGE,
        "startIndex" => $startIndex,
        "lastIndex" => $lastIndex
    );
}

function getCurrentPageURL($sort)
{
    $pageURL = 'http';
    if (!empty($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == 'on') {
            $pageURL .= "s";
        }
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL . $sort;
}
