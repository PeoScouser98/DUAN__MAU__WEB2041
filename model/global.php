<?php
$ROOT_AVATAR_ADMIN = "../assets/img/avatar/";
$IMG_ROOT_ADMIN = '../assets/img/products/';
$ROOT_AVATAR = "./assets/img/avatar/";
$IMG_ROOT = './assets/img/products/';
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
        $result .= " " . strtolower($subString[$i]);
    }
    return $result;
}


// upload file ảnh
function upload_file($directory, $inputFileName)
{
    if (isset($_FILES)) {
        $file_name = $_FILES[$inputFileName]['full_path'];
        $path = $directory . $file_name;
        move_uploaded_file($_FILES[$inputFileName]['tmp_name'], $path);
        return $file_name;
    }
}
// upload file = ftp
function ftp_upload_file($inputName, $remote_dir)
{
    if (isset($_FILES[$inputName])); {
        $ftp_hostname = "ftpupload.net";
        $ftp_username = "b32_31975564";
        $fpt_password = "03011998";
        $port = 21;
        // source file
        $src_file = $_FILES[$inputName]['tmp_name'];
        if ($src_file != '') {
            $dst_file = $remote_dir . $_FILES[$inputName]['name']; // directory to upload
            $ftp_conn = ftp_connect($ftp_hostname, $port) or die("cannot connect to ftp server!");
            ftp_login($ftp_conn, $ftp_username, $fpt_password);
            ftp_pasv($ftp_conn, true);
            // check connection to ftp server
            if (ftp_put($ftp_conn, $dst_file, $src_file, FTP_ASCII)) {  // upload file
                echo "<script>alert(`Uploaded !`)</script>";
                return $_FILES[$inputName]['name'];
            } else {
                echo "<script>alert(`Cannot upload!`)</script>";
                return false;
            }
            ftp_close($ftp_conn); // close connection
        }
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
