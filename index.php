<?php
// Include các file cần thiết
include 'model/connect.php';
include 'model/employee.php';



?>

<?php
session_start();

// Đếm số loại sách có trong giỏ hàng ( khác nhau )
$totalQuantity = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
$isLoggedIn = isset($_SESSION['user']);
include 'model/navbar.php';


$books = loadAll(); 
$booksPerRow = 5; 
$rowsPerPage = 2; 


$totalBooks = count($books);


$totalPages = ceil($totalBooks / ($booksPerRow * $rowsPerPage));


$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $totalPages) $page = $totalPages;


$startIndex = ($page - 1) * $booksPerRow * $rowsPerPage;
$booksToShow = array_slice($books, $startIndex, $booksPerRow * $rowsPerPage);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Bán Sách Online</title>
    <link rel="stylesheet" href="/css/home.css">
</head>
<body>
    <div class="container">
        <h1>SÁCH MỚI</h1>
        <div class="slideshow-container">
            <?php
            $books = load(); // Lấy danh sách sách từ database
            $chunks = array_chunk($books, 5); 

            foreach ($chunks as $index => $chunk) {
                echo '<div class="slide">';
                echo '<div class="books">';
                foreach ($chunk as $book) {
                    echo '<div class="book">';

                    echo '<a href="/php/book_detail.php?masach=' . $book['masach'] . '">';
                    echo '<img src="' . htmlspecialchars($book['image']) . '" alt="' . htmlspecialchars($book['tensach']) . '">';
                    echo '</a>';
                    echo '<h3>' . htmlspecialchars($book['tensach']) . '</h3>';
                    echo '<p>Giá: ' . number_format($book['gia'], 0, ',', '.') . ' VNĐ</p>';
                    echo '<button><a href="/php/cart.php?add_to_cart=1&book_id=' . $book['masach'] . '&book_name=' . urlencode($book['tensach']) . '&book_price=' . $book['gia'] . '&book_image=' . urlencode($book['image']) . '">
                            Thêm vào giỏ hàng</a></button>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <!-- Nút điều hướng -->
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>


    <h1>TẤT CẢ SÁCH</h1>
    <div class="books-list-container">
    <div class="books-list">
        <?php
        foreach ($booksToShow as $index => $book) {
            echo '<div class="book">';
            echo '<a href="/php/book_detail.php?masach=' . $book['masach'] . '">';
            echo '<img src="' . htmlspecialchars($book['image']) . '" alt="' . htmlspecialchars($book['tensach']) . '">';
            echo '</a>';
            echo '<h3>' . htmlspecialchars($book['tensach']) . '</h3>';
            echo '<p>Giá: ' . number_format($book['gia'], 0, ',', '.') . ' VNĐ</p>';
            echo '<button><a href="/php/cart.php?add_to_cart=1&book_id=' . $book['masach'] . '&book_name=' . urlencode($book['tensach']) . '&book_price=' . $book['gia'] . '&book_image=' . urlencode($book['image']) . '">Thêm vào giỏ hàng</a></button>';
            echo '</div>';
        }
        ?>
    </div>
</div>


    <!-- Phân trang -->
    <div class="pagination">
        <a href="?page=<?php echo $page - 1; ?>" <?php echo $page <= 1 ? 'class="disabled"' : ''; ?>>&#10094; Trước</a>
        <span>Trang <?php echo $page; ?> / <?php echo $totalPages; ?></span>
        <a href="?page=<?php echo $page + 1; ?>" <?php echo $page >= $totalPages ? 'class="disabled"' : ''; ?>>Tiếp &#10095;</a>
    </div>



    <script src="scripts/script.js"></script>

    

    <footer id="footer">
        
    <div class="footer-container">
        <p>&copy; KC_BookStore. </p>

        <div class="person-info khang">
            <h3>Đinh Phạm Phú Khang</h3>
            <p>MSSV: DH52108453</p>
            <p>Lớp: D21_TH05</p>
            <p>Email: dh52108453@student.stu.edu.vn</p>
        </div>

        
        <div class="person-info chinh">
            <h3>Hoàng Hữu Lê Chinh</h3>
            <p>MSSV: DH52108517</p>
            <p>Lớp: D21_TH05</p>
            <p>Email: dh52108517@student.stu.edu.vn</p>
        </div>
    </div>
</footer>




</body>
</html>
