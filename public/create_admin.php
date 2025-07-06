<?php
// Kết nối đến cơ sở dữ liệu
$host = 'localhost:3307';
$dbname = 'web_adidas_shoes';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Tạo tài khoản admin
    $admin_username = 'admin';
    $admin_email = 'admin@example.com';
    $admin_password = '24682468'; // Thay đổi mật khẩu tại đây
    $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->execute([$admin_username, $admin_email, $hashed_password]);
    
    echo "Tài khoản admin đã được tạo thành công!";
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
