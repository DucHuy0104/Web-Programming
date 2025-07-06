<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Kiểm tra quyền truy cập admin
if (!isAdmin()) {
    redirect('login.php');
}

// Xử lý xóa loại sản phẩm
if (isset($_GET['delete'])) {
    $category_id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM categories WHERE category_id = ?");
    $stmt->execute([$category_id]);
    redirect('categories.php');
}

// Lấy danh sách loại sản phẩm
$stmt = $pdo->query("SELECT * FROM categories");
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$page_title = 'Quản lý loại sản phẩm';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Quản lý loại sản phẩm</h1>
        <a href="add_category.php" class="btn-primary">Thêm loại sản phẩm mới</a>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên loại sản phẩm</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category['category_id']; ?></td>
                    <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                    <td>
                        <a href="edit_category.php?id=<?php echo $category['category_id']; ?>" class="btn-edit">Sửa</a>
                        <a href="?delete=<?php echo $category['category_id']; ?>" class="btn-delete" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
