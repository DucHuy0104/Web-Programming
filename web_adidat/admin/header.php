<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h1>Admin</h1>
                <nav class="admin-nav">
                    <ul>
                        <li><a href="index.php">Dashboard</a></li>
                        <li><a href="products.php">Sản phẩm</a></li>
                        <li><a href="categories.php">Danh mục</a></li>
                        <li><a href="orders.php">Đơn hàng</a></li>
                        <li><a href="users.php">Người dùng</a></li>
                        <li><a href="../public/">Trang chủ</a></li>
                        <li><a href="logout.php">Đăng xuất</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>