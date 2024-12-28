<?php

    // Nhúng thư viện PHPMailer
    require_once '../PHPMailer-master/src/PHPMailer.php';
    require_once '../PHPMailer-master/src/SMTP.php';
    require_once '../PHPMailer-master/src/Exception.php';  // Thay đổi đường dẫn nếu bạn để thư mục khác

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


session_start();
require_once '../model/connect.php';

// Kiểm tra nếu không có giỏ hàng, chuyển về trang giỏ hàng
if (!isset($_POST['cart'])) {
    header('Location: checkout.php');
    exit;
}

// Giải mã giỏ hàng và tổng tiền từ POST
$cart = unserialize(base64_decode($_POST['cart']));
$total = $_POST['total'];

// Lấy thông tin từ form
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment_method = $_POST['payment_method'];

// Kết nối cơ sở dữ liệu
$conn = connectdb();

// Thêm đơn hàng vào bảng orders
try {
    $stmt = $conn->prepare("INSERT INTO donhang (tennguoinhan, diachinhan, sdtnguoinhan, emailnguoinhan, phuongthucthanhtoan, trangthai) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $address, $phone, $email, $payment_method, 'Đang xử lý']);

    // Lấy ID của đơn hàng vừa được thêm vào
    $order_id = $conn->lastInsertId();  // Sử dụng `lastInsertId` để lấy ID của đơn hàng vừa thêm vào

    // Thêm chi tiết đơn hàng vào bảng order_details
    $stmt = $conn->prepare("INSERT INTO chitietdonhang (madonhang, masach, soluongdat, tonggia) VALUES (?, ?, ?, ?)");
    foreach ($cart as $item) {
        if (isset($item['book_id'])) {
            // Tiến hành thêm vào cơ sở dữ liệu
            $bookId = $item['book_id'];
            $quantity = $item['quantity'];
            $total_price = $item['price'] * $quantity;
    
            // Thêm vào cơ sở dữ liệu
            $stmt->execute([$order_id, $bookId, $quantity, $total_price]);
        } else {
            echo "Lỗi: Mã sách không tồn tại trong giỏ hàng.";
            exit;
        }
    }
    // Đóng kết nối cơ sở dữ liệu
    $conn = null;

    // Cấu trúc email
    $order_details = "THÔNG TIN ĐƠN HÀNG\n\n";
    foreach ($cart as $item) {
        $order_details .= "Sản phẩm: " . htmlspecialchars($item['name']) . "\n";
        $order_details .= "Giá: " . number_format($item['price'], 0, ',', '.') . " VNĐ\n";
        $order_details .= "Số lượng: " . $item['quantity'] . "\n";
    }
    $order_details .= "Tổng cộng: " . number_format($total, 0, ',', '.') . " VNĐ\n\n";
    $order_details .= "THÔNG TIN GIAO HÀNG\n";
    $order_details .= "Họ và tên: $name\n";
    $order_details .= "Email: $email\n";
    $order_details .= "Số điện thoại: $phone\n";
    $order_details .= "Địa chỉ: $address\n";
    $order_details .= "Phương thức thanh toán: " . ($payment_method === 'cod' ? 'Thanh toán khi nhận hàng (COD)' : 'Chuyển khoản ngân hàng') . "\n";



    $mail = new PHPMailer;
    try {
        // Cấu hình máy chủ SMTP (ví dụ với Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Máy chủ SMTP (ví dụ: Gmail)
        $mail->SMTPAuth = true;
        $mail->Username = 'hoanghuulechinh3107@gmail.com';  // Thay đổi bằng email của bạn
        $mail->Password = 'pbcz mnbo qjlk rfei';  // Thay đổi bằng mật khẩu email của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Người gửi
        $mail->setFrom('hoanghuulechinh3107@gmail.com', 'KC_BookStore');  // Thay đổi bằng email và tên của bạn
        $mail->addAddress($email, $name);  // Địa chỉ email khách hàng

        // Tiêu đề và nội dung email
        $mail->isHTML(false);  // Chế độ email dạng văn bản
        $mail->Subject = 'Xác nhận đơn hàng của bạn';
        $mail->Body    = $order_details;

        // Đảm bảo mã hóa tiêu đề với UTF-8
        $mail->CharSet = 'UTF-8';

        // Gửi email
        $mail->send();
        echo "<p>Email xác nhận đã được gửi đến $email. Cảm ơn bạn đã đặt hàng!</p>";
        // Optionally: Chuyển hướng về trang cảm ơn
        //header("Location: thank_you.php");

    } catch (Exception $e) {
        echo "<p>Không thể gửi email xác nhận. Lỗi: {$mail->ErrorInfo}</p>";
    }
} catch (PDOException $e) {
    die("Lỗi khi thêm đơn hàng: " . $e->getMessage());
}

?>
