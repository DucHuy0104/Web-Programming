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
    $product_name = trim($_POST['product_name'] ?? '');
    $price = (int)$_POST['price'];
    $description = trim($_POST['description'] ?? '');
    $category_id = (int)$_POST['category_id'];
    $image_url = $_POST['image_url'] ?? '';
    $sizes_input = trim($_POST['sizes_input'] ?? ''); // Lấy kích thước từ form

    // Tách kích thước thành mảng
    $sizes = array_map('trim', explode(',', $sizes_input));

    if (empty($product_name) || $price <= 0 || empty($description) || $category_id <= 0) {
        $error = 'Vui lòng nhập đầy đủ thông tin';
    } else {
        // Thêm sản phẩm vào cơ sở dữ liệu
        $stmt = $pdo->prepare("INSERT INTO products (product_name, price, description, image_url, category_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$product_name, $price, $description, $image_url, $category_id]);
        $product_id = $pdo->lastInsertId();

        // Thêm kích thước vào cơ sở dữ liệu
        foreach ($sizes as $size) {
            if (!empty($size)) {
                $stmt = $pdo->prepare("INSERT INTO product_size (product_id, size_value) VALUES (?, ?)");
                $stmt->execute([$product_id, $size]);
            }
        }

        $success = 'Sản phẩm đã được thêm thành công!';
    }
}

// Lấy danh sách loại sản phẩm
$categories = getCategories($pdo);
$page_title = 'Thêm sản phẩm mới';
require_once 'header.php';
?>

<main>
    <div class="container">
        <h1>Thêm sản phẩm mới</h1>
        <?php if ($error): ?>
        <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="product_name">Tên sản phẩm:</label>
                <input type="text" id="product_name" name="product_name" required>
            </div>
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Loại sản phẩm:</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Chọn loại sản phẩm</option>
                    <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="image_url">URL hình ảnh:</label>
                <input type="text" id="image_url" name="image_url">
            </div>
            <div class="form-group">
                <label for="sizes_input">Kích thước (nhập từng kích thước, cách nhau bằng dấu phẩy):</label>
                <input type="text" id="sizes_input" name="sizes_input" placeholder="Ví dụ: S, M, L, XL">
            </div>
            <button type="submit" class="btn-primary">Thêm sản phẩm</button>
        </form>
    </div>
</main>

