<?php
include '../model/connect.php';
session_start();
$error_message = ''; // Khởi tạo biến lưu thông báo lỗi

// Xử lý đăng nhập
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $conn = connectdb();

    // Kiểm tra xem người dùng có phải là admin không
    $sql_admin = "SELECT * FROM admin WHERE adusername = :username LIMIT 1"; 
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bindParam(':username', $username);
    $stmt_admin->execute();

    $admin = $stmt_admin->fetch(PDO::FETCH_ASSOC); // Lấy kết quả từ bảng admin

    // Kiểm tra người dùng trong bảng admin
    if ($admin) {
        if ($password === $admin['adpassword']) {
            $_SESSION['admin'] = $admin['adusername'];
            header("Location: /admin/admin.php"); // Chuyển hướng về trang admin
            exit();
        } else {
            $error_message = 'Mật khẩu admin không đúng!';
        }
    } else {
        $sql = "SELECT * FROM khachhang WHERE username = :username LIMIT 1"; 
        $stmt = $conn->prepare($sql);  // Chuẩn bị câu lệnh SQL
        $stmt->bindParam(':username', $username);  // Gán tham số :username
        $stmt->execute();  // Thực thi câu lệnh SQL

        // Lấy kết quả từ truy vấn
        $user = $stmt->fetch(PDO::FETCH_ASSOC);  // Dùng fetch thay vì fetchAll để lấy một kết quả duy nhất


        if ($user) { // Nếu có người dùng trong cơ sở dữ liệu
            // So sánh mật khẩu người dùng nhập với mật khẩu gốc trong cơ sở dữ liệu
            if ($password === $user['password']) {
                $_SESSION['khachhang'] = $user['username'];
                header("Location: /index.php"); // Chuyển hướng về trang chính
                exit();
            } else {
                // Nếu mật khẩu không đúng
                $error_message = 'Mật khẩu không đúng!';
            }
        } else {
            // Nếu tài khoản không tồn tại
            $error_message = 'Tài khoản không tồn tại!';
        }
    }
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/css/login.css"> 
</head>
<body>
    <div class="auth-container">
        <form method="POST" action="">
            <h2>Đăng nhập</h2>
            <label for="username">Tài khoản:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>
            <!-- Hiển thị thông báo lỗi ngay dưới field mật khẩu -->
            <?php if ($error_message): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <button type="submit" name="login">Đăng nhập</button>
        </form>
        <p>Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
    </div>
</body>
</html>
