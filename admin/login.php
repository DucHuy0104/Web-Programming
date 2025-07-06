<?php
session_start(); // 🔴 Phải có để dùng $_SESSION
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
exit;

require_once '../includes/db.php';
require_once '../includes/functions.php';
exit;
// ✅ Nếu đã đăng nhập thì không cho vào trang login nữa
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    var_dump($_SESSION); // 🔍 Kiểm tra session đang có
    echo "<script>window.location.href='index.php';</script>";
    header('Location: index.php'); // ✅ Đúng cú pháp redirect
    exit;
}   

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        $error = 'Vui lòng nhập đầy đủ thông tin';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            redirect('index.php'); // ✅ Hàm redirect bạn đã dùng đúng rồi
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
        }
    }
}

$page_title = 'Đăng nhập - Quản trị';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Đăng nhập Quản trị</h1>
        <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        
    </div>
</main>
