<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$cart_items = getCartItems($pdo);
$cart_total = getCartTotal($cart_items);

// Handle cart updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantities'] as $key => $quantity) {
            if ($quantity <= 0) {
                unset($_SESSION['cart'][$key]);
            } else {
                $_SESSION['cart'][$key]['quantity'] = (int)$quantity;
            }
        }
        redirect('cart.php');
    }
    
    if (isset($_POST['remove_item'])) {
        $key = $_POST['remove_item'];
        unset($_SESSION['cart'][$key]);
        redirect('cart.php');
    }
}

$page_title = 'Giỏ hàng';
require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <h1 style="text-align: center; margin: 2rem 0; font-size: 2.5rem;">Giỏ hàng</h1>
        
        <?php if (empty($cart_items)): ?>
        <div style="text-align: center; padding: 4rem 0;">
            <h2>Giỏ hàng của bạn đang trống</h2>
            <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm.</p>
            <a href="index.php" class="btn-primary">Tiếp tục mua sắm</a>
        </div>
        <?php else: ?>
        
        <form method="POST">
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Size</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart_items as $item): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="../<?php echo htmlspecialchars($item['product']['image_url']); ?>" 
                                     alt="<?php echo htmlspecialchars($item['product']['product_name']); ?>" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px;"
                                     onerror="this.src='assets/images/no-image.jpg'">
                                <div>
                                    <h4><?php echo htmlspecialchars($item['product']['product_name']); ?></h4>
                                </div>
                            </div>
                        </td>
                        <td><?php echo htmlspecialchars($item['size']); ?></td>
                        <td><?php echo formatPrice($item['product']['price']); ?></td>
                        <td>
                            <input type="number" name="quantities[<?php echo $item['key']; ?>]" 
                                   value="<?php echo $item['quantity']; ?>" 
                                   min="1" style="width: 80px; padding: 0.5rem; text-align: center;">
                        </td>
                        <td><?php echo formatPrice($item['total']); ?></td>
                        <td>
                            <button type="submit" name="remove_item" value="<?php echo $item['key']; ?>" 
                                    class="btn-delete btn-small">Xóa</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin: 2rem 0;">
                <button type="submit" name="update_cart" class="btn-secondary">Cập nhật giỏ hàng</button>
                <a href="index.php" class="btn-secondary">Tiếp tục mua sắm</a>
            </div>
        </form>
        
        <div class="cart-summary">
            <h3>Tổng cộng</h3>
            <div style="display: flex; justify-content: space-between; margin: 1rem 0; font-size: 1.2rem; font-weight: bold;">
                <span>Tổng tiền:</span>
                <span><?php echo formatPrice($cart_total); ?></span>
            </div>
            <a href="checkout.php" class="btn-primary" style="width: 100%; text-align: center;">Thanh toán</a>
        </div>
        
        <?php endif; ?>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>