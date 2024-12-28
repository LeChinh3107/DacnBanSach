<?php
session_start();
$totalQuantity = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$isLoggedIn = isset($_SESSION['user']);
include '../model/navbar.php';
include '../model/connect.php'; // Gọi file kết nối database

// Lấy mã sách (masach) từ URL
$masach = isset($_GET['masach']) ? (int)$_GET['masach'] : 0;

// Kiểm tra xem mã sách có hợp lệ không
if ($masach <= 0) {
    die("Mã sách không hợp lệ.");
}

// Truy vấn lấy thông tin chi tiết sách
$sql = "
    SELECT 
        s.masach, s.tensach, s.image, s.mota, s.gia, s.soluong,
        tg.tentacgia,
        tl.tentheloai
    FROM 
        sach s
    LEFT JOIN 
        tacgia tg ON s.matacgia = tg.matacgia
    LEFT JOIN 
        theloai tl ON s.matheloai = tl.matheloai
    WHERE 
        s.masach = :masach
";

// Chuẩn bị câu lệnh và thực thi
$conn = connectdb();
$stmt = $conn->prepare($sql);
$stmt->bindParam(':masach', $masach, PDO::PARAM_INT);
$stmt->execute();

// Lấy kết quả
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Kiểm tra xem sách có tồn tại không
if (!$book) {
    die("Không tìm thấy sách.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi Tiết Sách</title>
    <link rel="stylesheet" href="/css/book_detail.css">
</head>
<body>
    <div class="container">
        <div class="book-container">
            <!-- Hiển thị hình ảnh sách -->
            <div class="book-image">
                <img src="<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['tensach']) ?>">
                <button class="add-to-cart">
                    <a href="/php/cart.php?add_to_cart=1&book_id=<?php echo $book['masach']; ?>&book_name=<?php echo urlencode($book['tensach']); ?>&book_price=<?php echo $book['gia']; ?>">
                        Thêm vào giỏ hàng
                    </a>
                </button>
            </div>

            <!-- Hiển thị thông tin sách -->
            <div class="book-info">
                <h2><?= htmlspecialchars($book['tensach']) ?></h2>
                <p><strong>Tác giả:</strong> <?= htmlspecialchars($book['tentacgia']) ?></p>
                <p><strong>Thể loại:</strong> <?= htmlspecialchars($book['tentheloai']) ?></p>
                <p><strong>Giá:</strong> <?= number_format($book['gia'], 0, ',', '.') ?> VND</p>
                <p><strong>Số lượng tồn kho:</strong> <?= (int)$book['soluong'] ?></p>
                <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($book['mota'])) ?></p>
            </div>
        </div>
    </div>
</body>
</html>
