<?php
session_start();
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy thông tin khách hàng
    $customer_name = $_POST['customer_name'];
    $phone_number = $_POST['phone'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $address = $_POST['address'];
    $note = $_POST['note'];
    $status = 'Chưa xác nhận';

    // Tính tổng tiền và kiểm tra dữ liệu giỏ hàng
    $total = 0;
    $valid_cart = true;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['quantity'], $item['price']) && $item['quantity'] > 0 && $item['price'] !== null) {
                $total += $item['quantity'] * $item['price'];
            } else {
                $valid_cart = false;
                break;
            }
        }
    } else {
        $valid_cart = false;
    }

    if (!$valid_cart) {
        echo "Giỏ hàng trống hoặc có sản phẩm không hợp lệ.";
    } else {
        // Lưu đơn hàng vào CSDL
        $stmt = $pdo->prepare("INSERT INTO orders (customer_name, phone_number, email, city, district, address, note, status, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$customer_name, $phone_number, $email, $city, $district, $address, $note, $status, $total]);
        $order_id = $pdo->lastInsertId();

        // Lưu chi tiết đơn hàng
        $stmtDetail = $pdo->prepare("INSERT INTO order_details (order_id, product_id, size_value, quantity, unit_price) VALUES (?, ?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $item) {
            if (isset($item['product_id'], $item['size'], $item['quantity'], $item['price'])) {
                $stmtDetail->execute([
                    $order_id,
                    $item['product_id'],
                    $item['size'],
                    $item['quantity'],
                    $item['price']
                ]);
            }
        }

        // Xóa giỏ hàng
        unset($_SESSION['cart']);
        echo "Đơn hàng của bạn đã được đặt thành công!";
    }
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
            <input type="text" id="phone" name="phone" required>
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