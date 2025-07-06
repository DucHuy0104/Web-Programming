<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$category_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$category_name = '';

// Hàm lấy sản phẩm theo danh mục
if ($category_id) {
    $stmt = $pdo->prepare("SELECT category_name FROM categories WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $category_name = $stmt->fetchColumn();
    
    if (!$category_name) {
        header('Location: index.php');
        exit;
    }
    
    $products = getProductsByCategory($pdo, $category_id);
    $page_title = $category_name;
} else {
    $products = getProductsByCategory($pdo);
    $page_title = 'Tất cả sản phẩm';
}

require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <nav style="padding: 1rem 0; color: #666;">
            <a href="index.php">Trang chủ</a> > <?php echo htmlspecialchars($page_title); ?>
        </nav>
        
        <h1 style="text-align: center; margin: 2rem 0; font-size: 2.5rem;"><?php echo htmlspecialchars($page_title); ?></h1>
        
        <div class="products-grid">
            <?php foreach ($products as $product): ?>
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
        
        <?php if (empty($products)): ?>
        <div style="text-align: center; padding: 4rem 0;">
            <h2>Không có sản phẩm nào</h2>
            <p>Hiện tại chưa có sản phẩm nào trong danh mục này.</p>
            <a href="index.php" class="btn-primary">Quay lại trang chủ</a>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>