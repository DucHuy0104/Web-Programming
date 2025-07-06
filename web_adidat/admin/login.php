<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';
   

$error = '';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
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
            redirect('index.php');
            //header('index.php');
        } else {
            $error = 'Tên đăng nhập hoặc mật khẩu không đúng';
        }
    }
}
// Nếu đã đăng nhập thì chuyển sang index.php
if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    header("Location: index.php");
    exit();
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
        
        <form method="POST">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Đăng nhập</button>
        </form>
    </div>
</main>




