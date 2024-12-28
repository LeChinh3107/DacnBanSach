<?php
session_start();
include '../model/connect.php';
include '../model/navbar.php';

// Lấy từ khóa tìm kiếm từ form
$query = isset($_GET['query']) ? trim($_GET['query']) : '';

if (!$query) {
    die("Vui lòng nhập từ khóa để tìm kiếm.");
}

// Kết nối đến database
$conn = connectdb();

// Tìm kiếm sách
$sql = "
    SELECT masach, tensach, image, gia 
    FROM sach 
    WHERE tensach LIKE :query
";
$stmt = $conn->prepare($sql);
$stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="/css/search.css">
</head>
<body>
    <div class="container">
        <h1>Kết quả tìm kiếm cho: "<?= htmlspecialchars($query) ?>"</h1>
        <div class="books-list">
            <?php if (count($results) > 0): ?>
                <?php foreach ($results as $book): ?>
                    <div class="book">
                        <a href="/php/book_detail.php?masach=<?= $book['masach'] ?>">
                            <img src="/<?= $book['image'] ?>" alt="<?= htmlspecialchars($book['tensach']) ?>">
                            <h3><?= htmlspecialchars($book['tensach']) ?></h3>
                        </a>
                        <p>Giá: <?= number_format($book['gia'], 0, ',', '.') ?> VND</p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không tìm thấy sách nào phù hợp với từ khóa.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
