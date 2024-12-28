<?php
include '../model/connect.php';
// Xử lý đăng ký
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $tenkhachhang = $_POST['tenkhachhang'];
    $username = $_POST['username'];
    $password = $_POST['password'];  // Không mã hóa mật khẩu
    try {
        // Kiểm tra xem tên tài khoản đã tồn tại chưa
        $conn = connectdb();
        $sql = "SELECT * FROM khachhang WHERE username = :username LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<p class='error-message'>Tài khoản đã tồn tại!</p>";
        } else {
        // Chèn dữ liệu vào cơ sở dữ liệu mà không mã hóa mật khẩu
        $sql = "INSERT INTO khachhang (tenkhachhang, username, password) VALUES (:tenkhachhang, :username, :password)";
        $params = [
            ':tenkhachhang' => $tenkhachhang,
            ':username' => $username,
            ':password' => $password,  // Lưu mật khẩu gốc vào cơ sở dữ liệu
        ];
        if (executeSQL($sql, $params)) {
            echo "<p class='success-message'>Đăng ký thành công!</p>";
            header('Location: /php/login.php');
        } else {
            echo "<p class='error-message'>Đăng ký thất bại!</p>";
        }
    }
    $conn = null;
    } catch (PDOException $e) {
        echo "Lỗi SQL: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="/css/register.css"> 
</head>
<body>
    <form method="POST" action="">
        <h2>ĐĂNG KÝ</h2>
        <label for="tenkhachhang">Tên khách hàng:</label>
        <input type="text" name="tenkhachhang" id="tenkhachhang" required>

        <label for="username">Tài khoản:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Mật khẩu:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="register">Đăng ký</button>
    </form>
</body>
</html>
