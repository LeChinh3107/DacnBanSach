<?php
session_start();

// Kiểm tra xem người dùng đã đăng nhập với quyền admin chưa
if (!isset($_SESSION['admin'])) {
    header("Location: login.php"); 
    exit();
}

// Để sử dụng thông tin admin
$admin_username = $_SESSION['admin'];

// Kiểm tra xem có yêu cầu hiển thị thông tin tài khoản hay đơn hàng không
$page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Nếu không có tham số 'page', mặc định là trang home
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Quản Trị</title>
    <link rel="stylesheet" href="/admin/admin.css"> 
</head>
<body>
    <!-- Sidebar (Bên trái) -->
    <div class="sidebar">
        <div class="profile">
            <img src="/image/admin.png" alt="User Icon" class="user-icon">
            <h3>Admin</h3>
        </div>
        <ul class="menu">
            <li><a href="?page=accounts">Tài Khoản</a></li>
            <li><a href="?page=orders">Đơn Hàng</a></li>
            <li><a href="/php/logout.php">Đăng xuất</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Chào mừng Admin</h1>

        <?php
        // Hiển thị danh sách tài khoản
        if ($page === 'accounts') {
            include '../model/connect.php'; 
            $conn = connectdb(); 
            $sql = "SELECT * FROM khachhang"; 
            $result = $conn->query($sql);
            if ($result->rowCount() > 0) {
                echo "<h2>Danh sách Tài Khoản</h2>";
                echo "<table>
                        <tr>
                            <th>Mã khách hàng</th>
                            <th>Tên khách hàng</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Thao tác</th>
                        </tr>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['makhachhang']) . "</td>
                            <td>" . htmlspecialchars($row['tenkhachhang']) . "</td>
                            <td>" . htmlspecialchars($row['username']) . "</td>
                            <td>" . htmlspecialchars($row['password']) . "</td>
                            <td>
                                <a href='delete.php?id=" . htmlspecialchars($row['makhachhang']) . "' class='button' onclick='return confirm(\"Bạn có chắc chắn muốn xóa khách hàng này?\")'>Xóa</a>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Không có tài khoản nào.</p>";
            }
            $conn = null;
        } 
        ?>

        <?php
        // Hiển thị danh sách đơn hàng
        if ($page === 'orders') {
            include '../model/connect.php'; 
            $conn = connectdb(); 
            $sql = "SELECT * FROM donhang"; 
            $result = $conn->query($sql);
            if ($result->rowCount() > 0) {
                echo "<h2>Danh sách Đơn Hàng</h2>";
                echo "<table>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ nhận</th>
                            <th>Số điện thoại người nhận</th>
                            <th>Email người nhận</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>";
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['madonhang']) . "</td>
                            <td>" . htmlspecialchars($row['tennguoinhan']) . "</td>
                            <td>" . htmlspecialchars($row['diachinhan']) . "</td>
                            <td>" . htmlspecialchars($row['sdtnguoinhan']) . "</td>
                            <td>" . htmlspecialchars($row['emailnguoinhan']) . "</td>
                            <td>" . htmlspecialchars($row['phuongthucthanhtoan']) . "</td>
                            <td>" . htmlspecialchars($row['trangthai']) . "</td>
                            <td>
                                <a href='edit_order.php?id2=" . htmlspecialchars($row['madonhang']) . "' class='button'>Sửa</a>
                                <a href='delete.php?id2=" . htmlspecialchars($row['madonhang']) . "' class='button' onclick='return confirm(\"Bạn có chắc chắn muốn xóa đơn hàng này?\")'>Xóa</a>
                            </td>
                        </tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Không có đơn hàng nào.</p>";
            }
            $conn = null;
        }
        ?>
    </div>
</body>
</html>
