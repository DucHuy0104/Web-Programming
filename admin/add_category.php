<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập admin
if (!isAdmin()) {
    redirect('login.php');
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name'] ?? '');

    if (empty($category_name)) {
        $error = 'Vui lòng nhập tên loại sản phẩm';
    } else {
        $stmt = $pdo->prepare("INSERT INTO categories (category_name) VALUES (?)");
        $stmt->execute([$category_name]);
        $success = 'Loại sản phẩm đã được thêm thành công!';
    }
}

$page_title = 'Thêm loại sản phẩm mới';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Thêm loại sản phẩm mới</h1>
        <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="category_name">Tên loại sản phẩm:</label>
                <input type="text" id="category_name" name="category_name" required>
            </div>
            <button type="submit" class="btn-primary">Thêm loại sản phẩm</button>
        </form>
    </div>
</main>

