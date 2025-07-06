<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập admin
if (!isAdmin()) {
    redirect('login.php');
}

// Kiểm tra order_id được truyền vào
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    redirect('orders.php'); // Quay lại trang danh sách đơn hàng nếu không có id
}
$order_id = (int)$_GET['id'];

// Lấy thông tin đơn hàng
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->execute([$order_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

// Lấy chi tiết đơn hàng
$stmt_details = $pdo->prepare("
    SELECT od.*, p.product_name 
    FROM order_details od 
    JOIN products p ON od.product_id = p.product_id 
    WHERE od.order_id = ?
");
$stmt_details->execute([$order_id]);
$order_details = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Chi tiết đơn hàng';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Chi tiết đơn hàng #<?php echo $order_id; ?></h1>
        <h2>Tên khách hàng: <?php echo htmlspecialchars($order['customer_name']); ?></h2>
        <h3>Ngày đặt: <?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></h3>
        <h3>Tổng tiền: <?php echo formatPrice($order['total']); ?></h3>
        <h3>Trạng thái: <?php echo htmlspecialchars($order['status']); ?></h3>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($order_details as $detail): ?>
                <tr>
                    <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($detail['size_value']); ?></td>
                    <td><?php echo $detail['quantity']; ?></td>
                    <td><?php echo formatPrice($detail['unit_price']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

