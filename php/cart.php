<?php

session_start();
$totalQuantity = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$isLoggedIn = isset($_SESSION['user']);
include '../model/navbar.php';
include '../model/connect.php'; 


$conn = connectdb();


$message = '';


function getBookStock($bookId, $conn) {
    $sql = "SELECT soluong FROM sach WHERE masach = :bookId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn();
}

// Xử lý thêm sách vào giỏ hàng
if (isset($_GET['add_to_cart'])) {
    $bookId = $_GET['book_id'];  
    $bookName = $_GET['book_name'];  
    $bookPrice = $_GET['book_price'];  
    $bookImage = $_GET['book_image'];  // Đường dẫn ảnh

    // Kiểm tra số lượng tồn kho
    $stock = getBookStock($bookId, $conn);

    // Nếu giỏ hàng chưa tồn tại
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Kiểm tra số lượng trong giỏ hàng
    $currentQuantity = isset($_SESSION['cart'][$bookId]) ? $_SESSION['cart'][$bookId]['quantity'] : 0;

    // Kiểm tra nếu tổng số lượng vượt quá tồn kho
    if ($currentQuantity + 1 > $stock) {
        $_SESSION['message'] = "Vượt quá số lượng sách có trong kho, không thể thêm nữa.";
    } else {
        // Thêm sách vào giỏ hàng hoặc tăng số lượng
        if (isset($_SESSION['cart'][$bookId])) {
            $_SESSION['cart'][$bookId]['quantity']++;
        } else {
            $_SESSION['cart'][$bookId] = [
                'name' => $bookName,
                'price' => $bookPrice,
                'quantity' => 1,
                'book_id' => $bookId,
                'image' => $bookImage,
            ];
        }
    }

    header('Location: cart.php');
    exit;
}

// Xử lý tăng số lượng sách trong giỏ hàng
if (isset($_GET['increase_quantity'])) {
    $bookId = $_GET['book_id'];

    // Kiểm tra số lượng tồn kho
    $stock = getBookStock($bookId, $conn);

    // Kiểm tra nếu sách có trong giỏ hàng
    if (isset($_SESSION['cart'][$bookId])) {
        $currentQuantity = $_SESSION['cart'][$bookId]['quantity'];

        // Kiểm tra nếu số lượng vượt quá tồn kho
        if ($currentQuantity + 1 > $stock) {
            $_SESSION['message'] = "Vượt quá số lượng sách có trong kho.";
        } else {
            // Tăng số lượng sách
            $_SESSION['cart'][$bookId]['quantity']++;
        }
    }

    // Quay lại trang giỏ hàng
    header('Location: cart.php');
    exit;
}

// Xử lý giảm số lượng sách trong giỏ hàng
if (isset($_GET['decrease_quantity'])) {
    $bookId = $_GET['book_id'];

    // Kiểm tra nếu sách có trong giỏ hàng
    if (isset($_SESSION['cart'][$bookId])) {
        // Giảm số lượng sách
        $_SESSION['cart'][$bookId]['quantity']--;

        // Nếu số lượng bằng 0, xóa sách khỏi giỏ hàng
        if ($_SESSION['cart'][$bookId]['quantity'] <= 0) {
            unset($_SESSION['cart'][$bookId]);
        }
    }

    // Quay lại trang giỏ hàng
    header('Location: cart.php');
    exit;
}

// Xử lý xóa sách khỏi giỏ hàng
if (isset($_GET['remove_from_cart'])) {
    $bookId = $_GET['book_id'];

    // Kiểm tra xem sách có trong giỏ hàng không và xóa nó
    if (isset($_SESSION['cart'][$bookId])) {
        unset($_SESSION['cart'][$bookId]);
    }

    // Quay lại trang giỏ hàng
    header('Location: cart.php');
    exit;
}

// Hiển thị giỏ hàng
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="/css/cart.css">
</head>
<body>
    <h1>GIỎ HÀNG CỦA BẠN</h1>
    <?php if (!empty($message)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>Ảnh</th>
            <th>Tên sách</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Hành động</th>
        </tr>
        <?php if (empty($cart)): ?>
            <tr>
                <td colspan="6">Giỏ hàng trống!</td>
            </tr>
        <?php else: ?>
            <?php foreach ($cart as $bookId => $book): ?>
                <tr>
                    <td>
                        <img src="<?php echo htmlspecialchars($book['image']); ?>" alt="" style="width: 100px; height: auto;">
                    </td>
                    <td><?php echo htmlspecialchars($book['name']); ?></td>
                    <td><?php echo number_format($book['price'], 0, ',', '.'); ?> VNĐ</td>
                    <td>
                        <!-- Nút cộng số lượng -->
                        <a href="cart.php?increase_quantity=1&book_id=<?php echo $bookId; ?>" class="button plus">+</a>
                        <?php echo $book['quantity']; ?>
                        <!-- Nút trừ số lượng -->
                        <a href="cart.php?decrease_quantity=1&book_id=<?php echo $bookId; ?>" class="button minus">-</a>
                    </td>

                    <td><?php echo number_format($book['price'] * $book['quantity'], 0, ',', '.'); ?> VNĐ</td>
                    <td>
                        <!-- Liên kết xóa sách khỏi giỏ hàng -->
                        <a href="cart.php?remove_from_cart=1&book_id=<?php echo $bookId; ?>" class="button delete">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <div class="container">
        <a href="/index.php" class="continue-shopping">Tiếp tục mua hàng</a>
        <a href="/php/checkout.php" class="continue-shopping">Thanh toán</a>
    </div>

</body>
</html>
