<?php
// Kiểm tra nếu không phải admin thì chuyển hướng về trang đăng nhập
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
include '../model/connect.php';
$conn = connectdb();

// Lấy mã đơn hàng từ tham số GET
if (isset($_GET['id2'])) {
    $madonhang = $_GET['id2'];
    
    // Lấy thông tin đơn hàng từ cơ sở dữ liệu
    $sql = "SELECT * FROM donhang WHERE madonhang = :madonhang";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':madonhang', $madonhang, PDO::PARAM_INT);
    $stmt->execute();
    
    $order = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$order) {
        echo "Đơn hàng không tồn tại.";
        exit();
    }
} else {
    echo "Không có mã đơn hàng.";
    exit();
}


$successMessage = '';
// Xử lý khi người dùng submit form sửa đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tennguoinhan = $_POST['tennguoinhan'];
    $diachinhan = $_POST['diachinhan'];
    $sdtnguoinhan = $_POST['sdtnguoinhan'];
    $emailnguoinhan = $_POST['emailnguoinhan'];
    $phuongthucthanhtoan = $_POST['phuongthucthanhtoan'];
    $trangthai = $_POST['trangthai'];

    // Cập nhật thông tin đơn hàng vào cơ sở dữ liệu
    $updateSql = "UPDATE donhang SET 
                    tennguoinhan = :tennguoinhan, 
                    diachinhan = :diachinhan, 
                    sdtnguoinhan = :sdtnguoinhan, 
                    emailnguoinhan = :emailnguoinhan, 
                    phuongthucthanhtoan = :phuongthucthanhtoan, 
                    trangthai = :trangthai 
                  WHERE madonhang = :madonhang";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bindParam(':tennguoinhan', $tennguoinhan);
    $updateStmt->bindParam(':diachinhan', $diachinhan);
    $updateStmt->bindParam(':sdtnguoinhan', $sdtnguoinhan);
    $updateStmt->bindParam(':emailnguoinhan', $emailnguoinhan);
    $updateStmt->bindParam(':phuongthucthanhtoan', $phuongthucthanhtoan);
    $updateStmt->bindParam(':trangthai', $trangthai);
    $updateStmt->bindParam(':madonhang', $madonhang);
    
    if ($updateStmt->execute()) {
        echo "Cập nhật đơn hàng thành công!";
        header("Location: admin.php?page=orders"); 
        exit();
    } else {
        echo "Có lỗi xảy ra khi cập nhật đơn hàng.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn Hàng</title>
    <link rel="stylesheet" href="/admin/edit_order.css"> 
</head>
<body>
    <form method="POST">
    <h1>Thông Tin Đơn Hàng</h1>
        <label for="tennguoinhan">Tên Người Nhận:</label>
        <input type="text" id="tennguoinhan" name="tennguoinhan" value="<?php echo htmlspecialchars($order['tennguoinhan']); ?>" required><br>

        <label for="diachinhan">Địa Chỉ Nhận:</label>
        <input type="text" id="diachinhan" name="diachinhan" value="<?php echo htmlspecialchars($order['diachinhan']); ?>" required><br>

        <label for="sdtnguoinhan">Số Điện Thoại:</label>
        <input type="text" id="sdtnguoinhan" name="sdtnguoinhan" value="<?php echo htmlspecialchars($order['sdtnguoinhan']); ?>" required><br>

        <label for="emailnguoinhan">Email:</label>
        <input type="email" id="emailnguoinhan" name="emailnguoinhan" value="<?php echo htmlspecialchars($order['emailnguoinhan']); ?>" required><br>

        <label for="phuongthucthanhtoan">Phương Thức Thanh Toán:</label>
        <select id="phuongthucthanhtoan" name="phuongthucthanhtoan" required>
            <option value="Thanh toán khi nhận hàng (COD)" <?php if ($order['phuongthucthanhtoan'] == 'Thanh toán khi nhận hàng (COD)') echo 'selected'; ?>>Thanh toán khi nhận hàng (COD)</option>
            <option value="Chuyển khoản ngân hàng" <?php if ($order['phuongthucthanhtoan'] == 'Chuyển khoản ngân hàng') echo 'selected'; ?>>Chuyển khoản ngân hàng</option>
        </select><br>

        <label for="trangthai">Trạng Thái:</label>
        <select id="trangthai" name="trangthai" required>
            <option value="Chưa xử lý" <?php if ($order['trangthai'] == 'Chưa xử lý') echo 'selected'; ?>>Chưa xử lý</option>
            <option value="Đã xử lý" <?php if ($order['trangthai'] == 'Đã xử lý') echo 'selected'; ?>>Đã xử lý</option>
            <option value="Đang vận chuyển" <?php if ($order['trangthai'] == 'Đang vận chuyển') echo 'selected'; ?>>Đang vận chuyển</option>
            <option value="Đã giao" <?php if ($order['trangthai'] == 'Đã giao') echo 'selected'; ?>>Đã giao</option>
        </select><br>

         <!-- Thông báo thành công hoặc lỗi -->
         <?php if ($successMessage): ?>
            <div class="message"><?php echo $successMessage; ?></div>
        <?php endif; ?>

        <button type="submit">Cập Nhật</button>
    </form>
</body>
</html>
