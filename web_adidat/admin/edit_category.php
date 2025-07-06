<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập admin
if (!isAdmin()) {
    redirect('login.php');
}

$error = '';
$success = '';
$category_id = (int)$_GET['id'];

// Kiểm tra xem ID loại sản phẩm có hợp lệ không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_name = trim($_POST['category_name'] ?? '');

    if (empty($category_name)) {
        $error = 'Vui lòng nhập tên loại sản phẩm';
    } else {
        $stmt = $pdo->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
        $stmt->execute([$category_name, $category_id]);
        $success = 'Loại sản phẩm đã được cập nhật thành công!';
    }
}

// Lấy thông tin loại sản phẩm
$stmt = $pdo->prepare("SELECT * FROM categories WHERE category_id = ?");
$stmt->execute([$category_id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

$page_title = 'Sửa loại sản phẩm';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Sửa loại sản phẩm</h1>
        <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="category_name">Tên loại sản phẩm:</label>
                <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['category_name']); ?>" required>
            </div>
            <button type="submit" class="btn-primary">Cập nhật loại sản phẩm</button>
        </form>
    </div>
</main>


