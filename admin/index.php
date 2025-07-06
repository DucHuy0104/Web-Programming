    <?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Check admin access
if (!isAdmin()) {
    redirect('login.php');
}

// Get statistics
$stats = [];

$stmt = $pdo->query("SELECT COUNT(*) FROM products");
$stats['products'] = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM orders");
$stats['orders'] = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM users WHERE role = 'customer'");
$stats['customers'] = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT SUM(od.quantity * od.unit_price) FROM order_details od 
                    JOIN orders o ON od.order_id = o.order_id 
                    WHERE LOWER(o.status) = 'hoàn thành'");
$stats['revenue'] = $stmt->fetchColumn() ?: 0;


// Recent orders
$stmt = $pdo->query("SELECT o.*, 
                           (SELECT SUM(od.quantity * od.unit_price) FROM order_details od WHERE od.order_id = o.order_id) as total 
                    FROM orders o 
                    ORDER BY o.order_date DESC 
                    LIMIT 5");
$recent_orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Dashboard - Admin';
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
    
    <main class="admin-content">
        <div class="container">
            <h2>Dashboard</h2>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number"><?php echo number_format($stats['products']); ?></div>
                    <div class="stat-label">Sản phẩm</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-number"><?php echo number_format($stats['orders']); ?></div>
                    <div class="stat-label">Đơn hàng</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-number"><?php echo number_format($stats['customers']); ?></div>
                    <div class="stat-label">Khách hàng</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-number"><?php echo formatPrice($stats['revenue']); ?></div>
                    <div class="stat-label">Doanh thu</div>
                </div>
            </div>
            
            <h3>Đơn hàng gần đây</h3>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_orders as $order): ?>
                    <tr>
                        <td>#<?php echo $order['order_id']; ?></td>
                        <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                        <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                        <td><?php echo formatPrice($order['total']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>