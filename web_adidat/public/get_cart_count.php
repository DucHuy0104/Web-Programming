<?php
session_start();
header('Content-Type: application/json');
$cart_count = 0;
if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
// Tính tổng số lượng sản phẩm trong giỏ hàng
    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
}
// Hoặc nếu bạn chỉ muốn đếm số loại sản phẩm khác nhau:
// $cart_count = count($_SESSION['cart']);
}

echo json_encode(['count' => $cart_count]);
?>
        