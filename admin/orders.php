<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập admin
if (!isAdmin()) {
    redirect('login.php');
}

// Cập nhật trạng thái đơn hàng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = (int)$_POST['order_id'];
    $new_status = $_POST['status'];

    // Cập nhật trạng thái trong cơ sở dữ liệu
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
    $stmt->execute([$new_status, $order_id]);
}

// Lấy danh sách đơn hàng
//$stmt = $pdo->query("SELECT * FROM orders");
//$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmt = $pdo->prepare("
    SELECT 
        o.*, 
        IFNULL(SUM(od.quantity * od.unit_price), 0) AS total
    FROM orders o
    LEFT JOIN order_details od ON o.order_id = od.order_id
    GROUP BY o.order_id
    ORDER BY o.order_id DESC
");
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);


$page_title = 'Quản lý đơn hàng';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Quản lý đơn hàng</h1>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ngày giờ</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Ghi chú</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['order_date']); ?></td>
                    <td><?php echo htmlspecialchars($order['customer_name']); ?></td>
                    <td><?php echo htmlspecialchars($order['phone_number']); ?></td>
                    <td><?php echo htmlspecialchars($order['email']); ?></td>
                    <td><?php echo htmlspecialchars($order['address'].", ".$order['district'].", ".$order['city'] ); ?></td>
                    <td><?php echo htmlspecialchars($order['note']); ?></td>
                    <td>
                        <form method="POST" style="display: inline;">
                            <select name="status" onchange="this.form.submit()">
                                <option value="Chưa xác nhận" <?php echo $order['status'] == 'Chưa xác nhận' ? 'selected' : ''; ?>>Chưa xác nhận</option>
                                <option value="Chờ xử lý" <?php echo $order['status'] == 'Chờ xử lý' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                <option value="Hoàn thành" <?php echo $order['status'] == 'Hoàn thành' ? 'selected' : ''; ?>>Hoàn thành</option>
                            </select>
                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                        </form>
                    </td>
                    <td>
                        <?php 
                        // Kiểm tra xem khóa 'total' có tồn tại và có giá trị hợp lệ không
                        if (isset($order['total']) && $order['total'] > 0) {
                            echo formatPrice($order['total']); // Giả sử bạn có hàm formatPrice để định dạng giá
                        } else {
                            echo 'Chưa có'; // Hoặc một thông báo khác nếu không có tổng tiền
                        }
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
