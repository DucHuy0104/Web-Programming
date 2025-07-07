<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập
if (!isLoggedIn()) {
    redirect('login.php');
}

// Lấy thông tin người dùng
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cập nhật thông tin người dùng
    $username = $_POST['username'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE user_id = ?");
    $stmt->execute([$username, $email, $user_id]);

    // Thông báo thành công
    $message = "Thông tin đã được cập nhật.";
}

$page_title = 'Quản lý thông tin cá nhân';
require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <h1>Quản lý thông tin cá nhân</h1>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>

        <form method="POST">
            <div class="form-group">
                <label for="username">Tên người dùng:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
                
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>

            <button type="submit" class="btn-primary">Cập nhật</button>
        </form>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>