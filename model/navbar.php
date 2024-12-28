<?php

// Kiểm tra trạng thái đăng nhập
$isLoggedIn = isset($_SESSION['khachhang']) && is_array($_SESSION['khachhang']);
$khachhang = $isLoggedIn ? $_SESSION['khachhang'] : null;

// Giả định giỏ hàng
$totalQuantity = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
?>

<nav class="navbar">
    <link rel="stylesheet" href="../css/navbar.css">
    <div class="logo">
        <a href="/index.php">KC_BookStore</a>
    </div>
    <ul class="menu">
        <li><a href="/index.php">Trang chủ</a></li>
        <li class="dropdown">
            <a href="#">Thể loại</a>
            <ul class="dropdown-menu">
                <li><a href="/php/category.php?type=1">Sách Mới</a></li>
                <li><a href="/php/category.php?type=2">Văn Học</a></li>
                <li><a href="/php/category.php?type=3">Kinh Tế</a></li>
            </ul>
        </li>
        <li><a href="/index.php#footer">Thông tin</a></li> 
    </ul>
    <div class="search-bar">
        <form action="/php/search.php" method="get">
            <input type="text" name="query" placeholder="Nhập tên sách..." required>
            <button type="submit">Tìm kiếm</button>
        </form>
    </div>
    <div class="icons">
        <a href="/php/cart.php" class="icon-cart">
            <img src="/image/cart-icon.png" alt="Giỏ hàng">
            <span class="cart-count"><?php echo $totalQuantity; ?></span>
        </a>

        <!-- Biểu tượng User -->
        <?php if (isset($_SESSION['khachhang'])): ?>
            <div class="icon-user">
                <img src="/image/user-icon.png" alt="User">
                <div class="user-dropdown">
                    <p>Xin chào, <?php echo htmlspecialchars($_SESSION['khachhang']); ?></p>
                    <a href="/php/logout.php" class="logout-button">Đăng xuất</a>
                </div>
            </div>
        <?php else: ?>
            <!-- Chuyển hướng tới login.php khi chưa đăng nhập -->
            <a href="/php/login.php" class="icon-user">
                <img src="/image/user-icon.png" alt="User">
            </a>
        <?php endif; ?>
    </div>
</nav>
