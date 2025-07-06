<?php
// session_start();
// session_unset();
// session_destroy();
// //setcookie('username', '', time() - 3600, "/"); 
// header("Location: index.php");
// exit();

session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Nếu đã đăng nhập, lưu giỏ hàng vào cơ sở dữ liệu
if (isset($_SESSION['user_id'])) {
    // Xóa cookie
    setcookie('username', '', time() - 3600, "/"); // Xóa cookie
    setcookie('user_id', '', time() - 3600, "/"); // Xóa cookie
    
    // Xóa giỏ hàng cũ của người dùng
    $stmt = $pdo->prepare("DELETE FROM user_carts WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);

    // Lưu giỏ hàng mới vào cơ sở dữ liệu
    foreach ($_SESSION['cart'] as $item) {
        $stmt = $pdo->prepare("INSERT INTO user_carts (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)");
        $stmt->execute([$_SESSION['user_id'], $item['product_id'], $item['size'], $item['quantity']]);
    }
}

// Xóa session
session_destroy();

// Chuyển hướng về trang chủ
header('Location: index.php');
exit;

?>
