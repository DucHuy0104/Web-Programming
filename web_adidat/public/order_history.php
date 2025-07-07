<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập
if (!isLoggedIn()) {
    redirect('login.php');
}

// Lấy thông tin lịch sử đơn hàng
$user_id = $_SESSION['user_id']; // Giả sử bạn đã lưu user_id trong session
$stmt = $pdo->prepare("
    SELECT o.* FROM orders o
    WHERE o.user_id = ?
");

$stmt->execute([$user_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Lịch sử mua hàng';
require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <h1>Lịch sử mua hàng</h1>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Ngày đặt</th>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="7">Không có đơn hàng nào được tìm thấy.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <?php
                        // Lấy thông tin chi tiết đơn hàng
                        $stmtDetail = $pdo->prepare("
                            SELECT od.product_id, od.size_value, od.quantity, p.product_name 
                            FROM order_details od 
                            JOIN products p ON od.product_id = p.product_id 
                            WHERE od.order_id = ?
                        ");
                        $stmtDetail->execute([$order['order_id']]);
                        $details = $stmtDetail->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php foreach ($details as $detail): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></td>
                            <td><?php echo htmlspecialchars($detail['product_name']); ?></td>
                            <td><?php echo htmlspecialchars($detail['size_value']); ?></td>
                            <td><?php echo $detail['quantity']; ?></td>
                            <td><?php echo formatPrice($order['total']); ?></td>
                            <td><?php echo htmlspecialchars($order['status']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>
