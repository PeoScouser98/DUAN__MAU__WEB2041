<?php
function get_db_connection()
{
    $connection = new mysqli("localhost", "root", "", "ecommerce");
    if ($connection->connect_error) die($connection->connect_error);
    return $connection;
}
class CustomException2 extends Exception
{
    public function errorMessage()
    {
        //error message
        $errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
            . ': <b>' . $this->getMessage() . '</b> is not a valid E-Mail address.';
        return $errorMsg;
    }
}
// lấy 1 giá trị
function select_one_value($sql)
{
    try {
        // kết nối đến database
        $connection = get_db_connection();
        // chuẩn hóa câu truy vấn
        $statement = $connection->prepare($sql);
        // thực thi câu truy vấn
        if ($statement->execute()) {
            // kết quả truy vấn trả về
            $result = $statement->get_result();
            // truy xuất dữ liệu
            $data = $result->fetch_row();
            // giải phóng bộ nhớ của câu truy vấn
            $result->free_result();
            // đóng kết nối và trả về kết quả
            $connection->close();
            if (!is_null($data))  return $data[0];
            else throw new Exception("No Result");
        } else {
            throw new Exception("SQL Syntax Error!");
            return false;
        }
    } catch (Exception $e) {
        echo "<span class='text-danger fw-bold'>Message: {$e->getMessage()}</span>";
    }
}
// lấy 1 bản ghi 
function select_single_record($sql)
{
    try {
        // kết nối đến database
        $connection = get_db_connection();
        // chuẩn hóa câu truy vấn
        $statement = $connection->prepare($sql);
        // thực thi câu truy vấn
        if ($statement->execute()) {
            // kết quả truy vấn trả về
            $result = $statement->get_result();
            // truy xuất dữ liệu
            $data = $result->fetch_assoc();
            // giải phóng bộ nhớ của câu truy vấn
            $result->free_result();
            // đóng kết nối và trả về kết quả
            $connection->close();
            if (!is_null($data))  return $data;
            // else throw new Exception("No Result");
        } else throw new Exception("SQL SELECT Syntax Error!");
    } catch (Exception $e) {
        echo "<span class='text-danger fw-bold'>Message: {$e->getMessage()}</span>";
    }
}
// lấy tất cả bản ghi
function select_all_records($sql)
{
    try {
        // kết nối đến database
        $connection = get_db_connection();
        // chuẩn hóa câu truy vấn
        $statement = $connection->prepare($sql);
        // thực thi câu truy vấn
        if ($statement->execute()) {
            // kết quả truy vấn trả về
            $result = $statement->get_result();
            // truy xuất dữ liệu
            $data = $result->fetch_all(MYSQLI_ASSOC);
            // giải phóng bộ nhớ của câu truy vấn
            $result->free_result();
            // đóng kết nối và trả về kết quả
            $connection->close();
            if (!is_null($data))  return $data;
            // else throw new Exception("No Result");
        } else throw new Exception("SQL Syntax Error");
    } catch (Exception $e) {
        echo "<span class='text-danger fw-bold'>Message: {$e->getMessage()}</span>";
    }
}

function execute_query($sql)
{
    try {
        $connection = get_db_connection();
        $statement = $connection->prepare($sql);
        if ($statement->execute()) {
            $statement->close();
            return $connection->insert_id;
        } else {
            throw new Exception("SQL Syntax Error");
        }
    } catch (Exception $e) {
        echo "<span class='text-danger fw-bold'>Message: {$e->getMessage()}</span>";
    } finally {
        $connection->close();
    }
}
