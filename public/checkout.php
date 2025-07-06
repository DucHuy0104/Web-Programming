<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý thanh toán
    $customer_name = $_POST['customer_name'];
    $phone_number = $_POST['phone']; // Đổi từ 'phone_number' thành 'phone'
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $status = 'Chưa xác nhận';

    // Tính toán tổng tiền từ giỏ hàng
    $total = 0; // Khởi tạo tổng tiền
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['quantity']) && isset($item['price'])) { // Kiểm tra sự tồn tại của khóa
                $total += $item['quantity'] * $item['price']; // Tính tổng tiền
            } else {
                // Xử lý trường hợp không có giá hoặc số lượng
                echo "Một trong các mặt hàng không có giá hoặc số lượng.";
            }
        }
    } else {
        echo "Giỏ hàng trống.";
    }

    // Lưu đơn hàng vào CSDL, bao gồm tổng tiền
    $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone_number, email, city, district, address, note, status, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$customer_name, $phone_number, $email, $city, $district, $address, $note, $status, $total]);

    // Xóa giỏ hàng
    unset($_SESSION['cart']);
    echo "Đơn hàng của bạn đã được đặt thành công!";
}

include '../includes/header.php';
?>
<div class="container">
    <h1>Thanh toán</h1>
    <form method="POST">
        <div class="form-group">
            <label for="customer_name">Tên khách hàng:</label>
            <input type="text" id="customer_name" name="customer_name" required>
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required> <!-- Đảm bảo name là 'phone' -->
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Thành phố:</label>
            <input type="text" name="city" required>
        </div>
        <div class="form-group">
            <label>Quận/Huyện:</label>
            <input type="text" name="district" required>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label>Ghi chú:</label>
            <textarea name="note"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn-primary">Đặt hàng</button>
        </div>
    </form>
</div>
<?php include '../includes/footer.php'; ?>
