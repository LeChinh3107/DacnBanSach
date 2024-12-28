<?php
function connectdb()
{
    // $servername = "sql303.byethost31.com"; 
    // $username = "b31_37943013";        
    // $password = "LeChinhPhuKhang123..";  

    $servername = "localhost"; 
    $username = "root";        
    $password = "";           
    try 
    {
        // $conn = new PDO("mysql:host=$servername;dbname=b31_37943013_webbansach", $username, $password);
        $conn = new PDO("mysql:host=$servername;dbname=webbansach", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; 
    } 
    catch (PDOException $e) 
    {
        die("Connection failed: " . $e->getMessage());
    }
}

function selectSQL($sql, $params = [])
{
    $conn = connectdb();
    try {
        $stmt = $conn->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute($params); // Thực thi với các tham số
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy tất cả kết quả
        return $result; // Trả về kết quả
    } catch (PDOException $e) {
        // Hiển thị lỗi nếu có
        echo "Lỗi truy vấn SQL: " . $e->getMessage();
        return []; // Nếu thất bại, trả về mảng rỗng
    } finally {
        $conn = null; // Đóng kết nối
    }
}

function executeSQL($sql, $params = [])
{
    $conn = connectdb();
    try {
        $stmt = $conn->prepare($sql); // Chuẩn bị câu lệnh SQL
        $stmt->execute($params); // Thực thi với các tham số
        return true; // Nếu thành công, trả về true
    } catch (PDOException $e) {
        // Hiển thị lỗi nếu có
        echo "Lỗi thực thi SQL: " . $e->getMessage();
        return false; // Nếu thất bại, trả về false
    } finally {
        $conn = null; // Đóng kết nối
    }
}
?>