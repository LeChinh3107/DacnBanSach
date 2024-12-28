<?php
session_start();

// Kiểm tra giỏ hàng trong session
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// Tính tổng tiền
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin thanh toán</title>
    <link rel="stylesheet" href="/css/checkout.css">
</head>
<body>
    <div class="container">
        <!-- Cột trái: Thông tin giỏ hàng -->
        <div class="left-column">
            <h1>Thông tin đơn hàng</h1>

            <?php if (!empty($cart)): ?>
                <h2>Giỏ hàng của bạn</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VNĐ</td>
                                <td><?php echo $item['quantity']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="summary">
                    Tổng cộng: <?php echo number_format($total, 0, ',', '.'); ?> VNĐ
                </div>
                <?php else: ?>
                    <h2>Giỏ hàng trống!</h2>
                    <a href="/index.php" class="button">Quay lại mua hàng</a>
                <?php exit; ?>
            <?php endif; ?>
        </div>

        <!-- Cột phải: Form thông tin giao hàng -->
        <div class="right-column">
            <h1>Thông tin giao hàng</h1>
            <form action="order_confirm.php" method="POST">
                <input type="hidden" name="cart" value="<?php echo base64_encode(serialize($cart)); ?>">
                <input type="hidden" name="total" value="<?php echo $total; ?>">

                <div class="input-group">
                    <label for="name">Họ và tên:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                    <label for="phone">Số điện thoại:</label>
                    <input type="text" id="phone" name="phone" required>
                </div>

                <div class="input-group">
                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="input-group">
                    <label for="payment_method">Phương thức thanh toán:</label>
                    <select id="payment_method" name="payment_method" required>
                        <option value="Thanh toán khi nhận hàng (COD)">Thanh toán khi nhận hàng (COD)</option>
                        <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
                    </select>
                </div>

                <button type="submit">Xác nhận đơn hàng</button>
            </form>
        </div>
    </div>
</body>
</html>
