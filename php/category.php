<?php
include '../model/connect.php';

// Lấy tham số `type` từ URL
$type = isset($_GET['type']) ? intval($_GET['type']) : 0;

// Kiểm tra và xử lý loại thể loại
$categoryName = '';
switch ($type) {
    case 1:
        $categoryName = 'Sách Mới';
        break;
    case 2:
        $categoryName = 'Văn Học';
        break;
    case 3:
        $categoryName = 'Kinh Tế';
        break;
    default:
        $categoryName = 'Thể Loại Không Tồn Tại';
}

// Lấy danh sách sách từ database theo thể loại
if ($type > 0) {
    $sql = "SELECT * FROM sach WHERE matheloai = :type";
    $books = selectSQL($sql, ['type' => $type]);
} else {
    $books = [];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($categoryName); ?></title>
    <link rel="stylesheet" href="../css/home.css">
</head>
<body>
    <!-- Giao diện -->
    <?php include '../model/navbar.php'; ?>

    <div class="container">
        <h1><?php echo htmlspecialchars($categoryName); ?></h1>
        <?php if (count($books) > 0): ?>
            <div class="books-list">
                <?php foreach ($books as $book): ?>
                    <div class="book">
                        <a href="/php/book_detail.php?masach=<?php echo $book['masach']; ?>">
                            <img src="<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['tensach']) ?>">
                        </a>
                        <h3><?php echo htmlspecialchars($book['tensach']); ?></h3>
                        <p>Giá: <?php echo number_format($book['gia'], 0, ',', '.'); ?> VNĐ</p>
                        <button>
                            <a href="/php/cart.php?add_to_cart=1&book_id=<?php echo $book['masach']; ?>&book_name=<?php echo urlencode($book['tensach']); ?>&book_price=<?php echo $book['gia']; ?>">Thêm vào giỏ hàng</a>
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Không có sách nào thuộc thể loại này.</p>
        <?php endif; ?>
    </div>
</body>
</html>
