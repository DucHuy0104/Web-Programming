<?php
include("../connect.php"); // Kết nối đến database
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // hoặc login.php
    exit;
}
// Lấy dữ liệu từ form
$user_id = $_POST['user_id'] ?? null;
$product_name = $_POST['product_name'] ?? '';
$price = $_POST['price'] ?? '';
$image_url = $_POST['image_url'] ?? '';

if (!$user_id || !$product_name || !$price || !$image_url) {
    die("Thiếu dữ liệu để thêm vào giỏ hàng");
}
$sql = "INSERT INTO cart (user_id, product_name, price, image_url) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isds", $user_id, $product_name, $price, $image_url);

if ($stmt->execute()) {
    // Chuyển hướng sau khi thêm thành công
    header("Location: ../cart/carts.php");
    exit;
} else {
    echo "Lỗi khi thêm vào giỏ hàng: " . $stmt->error;
}
?>
<!DOCTYPE html>
<html>
<head><title>Thành công</title></head>
<body style="text-align:center; padding:50px; font-family:sans-serif; color:green;">
  <h2>✔️ Sản phẩm đã được thêm vào giỏ hàng!</h2>
  <a href="index.php">← Quay lại trang chính</a>
</body>
</html>
