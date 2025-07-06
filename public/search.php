<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$page_title = 'Tìm kiếm: ' . htmlspecialchars($query);
$search_results = [];

if ($query) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE product_name LIKE ? OR description LIKE ?");
    $searchTerm = '%' . $query . '%';
    $stmt->execute([$searchTerm, $searchTerm]);
    $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <h1 style="text-align: center; margin: 2rem 0; font-size: 2.5rem;">Kết quả tìm kiếm</h1>
        
        <?php if (empty($search_results)): ?>
        <div style="text-align: center; padding: 4rem 0;">
            <h2>Không tìm thấy sản phẩm nào</h2>
            <p>Vui lòng thử lại với từ khóa khác.</p>
            <a href="index.php" class="btn-primary">Quay lại trang chủ</a>
        </div>
        <?php else: ?>
        <div class="products-grid">
            <?php foreach ($search_results as $product): ?>
            <div class="product-card">
                <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                     class="product-image"
                     onerror="this.src='assets/images/no-image.jpg'">
                <div class="product-info">
                    <h3 class="product-title"><?php echo htmlspecialchars($product['product_name']); ?></h3>
                    <p class="product-price"><?php echo formatPrice($product['price']); ?></p>
                    <p class="product-description"><?php echo htmlspecialchars(substr($product['description'], 0, 100)) . '...'; ?></p>
                    <a href="product.php?id=<?php echo $product['product_id']; ?>" class="btn-primary">Xem chi tiết</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
