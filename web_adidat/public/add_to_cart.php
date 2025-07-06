<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

$response = ['success' => false];

header('Content-Type: application/json');

// Kiểm tra quyền truy cập người dùng
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $size = $_POST['size'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);

    if ($product_id > 0 && !empty($size) && $quantity > 0) {
        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
        $stmt = $pdo->prepare("SELECT * FROM products WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $product = $stmt->fetch();

        if ($product) {
            $price = (int)$product['price']; // đảm bảo có giá
            $name = $product['product_name'];

            // Thêm vào giỏ hàng trong session
            session_start();
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Kiểm tra nếu sản phẩm và size đã có thì cộng thêm số lượng
            $found = false;
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $product_id && $item['size'] == $size) {
                    $item['quantity'] += $quantity;
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $_SESSION['cart'][] = [
                    'product_id' => $product_id,
                    'name' => $name,
                    'size' => $size,
                    'quantity' => $quantity,
                    'price' => $price
                ];
            }
            // Nếu người dùng đã đăng nhập, lưu giỏ hàng vào cơ sở dữ liệu
            if (isset($_SESSION['user_id'])) {
                // Xóa giỏ hàng cũ của người dùng
                $stmt = $pdo->prepare("DELETE FROM user_carts WHERE user_id = ?");
                $stmt->execute([$_SESSION['user_id']]);
                // Lưu giỏ hàng mới vào cơ sở dữ liệu
                foreach ($_SESSION['cart'] as $item) {
                    $stmt = $pdo->prepare("INSERT INTO user_carts (user_id, product_id, size, quantity) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$_SESSION['user_id'], $item['product_id'], $item['size'], $item['quantity']]);
                }
            }
            
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Không tìm thấy sản phẩm']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Dữ liệu không hợp lệ']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Phải dùng phương thức POST']);
}


?>

