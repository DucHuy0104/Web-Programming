<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Nếu đã đăng nhập, chuyển hướng
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] === 'admin') {
        redirect('../admin/');
    } else {
        redirect('index.php');
    }
}
$error = '';

// Kiểm tra cookie
if (isset($_COOKIE['username']) && isset($_COOKIE['user_id'])) {
    // Nếu cookie tồn tại, tự động đăng nhập người dùng
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    
    // Chuyển hướng đến trang chính
    header("Location: index.php");
    exit();
}

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']); // Kiểm tra checkbox

    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ thông tin';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            // Nếu người dùng chọn ghi nhớ đăng nhập
            if ($remember) {
                // Tạo cookie với thời gian sống 7 ngày
                setcookie('username', $user['username'], time() + (7 * 24 * 60 * 60), "/"); // 7 ngày
                setcookie('user_id', $user['user_id'], time() + (7 * 24 * 60 * 60), "/"); // 7 ngày
            }

            // Đồng bộ giỏ hàng từ cơ sở dữ liệu vào session
            $stmt = $pdo->prepare("SELECT * FROM user_carts WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $_SESSION['cart'] = []; // Khởi tạo giỏ hàng
            foreach ($cart_items as $item) {
                $_SESSION['cart'][] = [
                    'product_id' => $item['product_id'],
                    'size' => $item['size'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'] // Nếu bạn muốn lưu giá
                ];
            }
            
            if ($user['role'] === 'admin') {
                redirect('../admin/');
            } else {
                redirect('index.php');
            }
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
        }
    }
}

$page_title = 'Đăng nhập';
require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <div style="max-width: 400px; margin: 4rem auto; background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
            <h1 style="text-align: center; margin-bottom: 2rem;">Đăng nhập</h1>
            
            <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="username">Tên đăng nhập hoặc Email:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div>
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ghi nhớ đăng nhập</label>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Đăng nhập</button>
            </form>
            
            <p style="text-align: center; margin-top: 2rem;">
                Chưa có tài khoản? <a href="register.php">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>