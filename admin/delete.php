<?php
// Kết nối tới cơ sở dữ liệu
include '../model/connect.php'; 
$conn = connectdb();

// Kiểm tra xem có tham số 'id' trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Lấy ID từ tham số 'id' trong URL

    // Xóa dữ liệu khỏi bảng 'khachhang'
    $sql = "DELETE FROM khachhang WHERE makhachhang = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<p>Đã xóa thành công khách hàng có mã $id.</p>";
    } else {
        echo "<p>Không thể xóa khách hàng. Vui lòng thử lại.</p>";
    }
    // Đóng kết nối cơ sở dữ liệu
    $conn = null;

    // Chuyển hướng lại trang quản trị
    header("Location: admin.php?page=accounts"); 
    exit();

} else {
    if (isset($_GET['id2'])) {
        $id = $_GET['id2']; // Lấy ID từ tham số 'id' trong URL
    
        // Xóa dữ liệu khỏi bảng 'chitietdonhang' trước
        $sql = "DELETE FROM chitietdonhang WHERE madonhang = :id2";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id2', $id, PDO::PARAM_INT);
        $stmt->execute();  // Xóa các bản ghi chi tiết đơn hàng
    
        // Xóa dữ liệu khỏi bảng 'donhang'
        $sql = "DELETE FROM donhang WHERE madonhang = :id2";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id2', $id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            echo "<p>Đã xóa thành công đơn hàng có mã $id2.</p>";
        } else {
            echo "<p>Không thể xóa đơn hàng. Vui lòng thử lại.</p>";
        }
    
        // Đóng kết nối cơ sở dữ liệu
        $conn = null;
    
        // Chuyển hướng lại trang quản trị
        header("Location: admin.php?page=orders"); 
        exit();
    
    }
}






?>
