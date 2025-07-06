<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = getProductById($pdo, $product_id);

if (!$product) {
    header('Location: index.php');
    exit;
}

$sizes = getProductSizes($pdo, $product_id);
$page_title = $product['product_name'];

require_once '../includes/header.php';
?>

<main>
    <div class="container">
        <nav style="padding: 1rem 0; color: #666;">
            <a href="index.php">Trang chủ</a> > 
            <a href="category.php?id=<?php echo $product['category_id']; ?>"><?php echo htmlspecialchars($product['category_name']); ?></a> > 
            <?php echo htmlspecialchars($product['product_name']); ?>
        </nav>
        
        <div class="product-detail">
            <div class="product-images">
                <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($product['product_name']); ?>" 
                     class="product-main-image"
                     onerror="this.src='assets/images/no-image.jpg'">
            </div>
            
            <div class="product-details">
                <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
                <p class="product-price-large"><?php echo formatPrice($product['price']); ?></p>
                
                <div class="product-description" style="margin-bottom: 2rem; line-height: 1.8;">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </div>
                
                <?php if (!empty($sizes)): ?>
                <div class="size-selector">
                    <label><strong>Chọn size:</strong></label>
                    <div class="size-options">
                        <?php foreach ($sizes as $size): ?>
                        <button class="size-option" data-size="<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php else: ?>
                <p>Không có kích thước nào cho sản phẩm này.</p>
                <?php endif; ?>
                
                <div class="quantity-selector">
                    <label><strong>Số lượng:</strong></label>
                    <button type="button" id="quantity-minus">-</button>
                    <input type="number" id="quantity" value="1" min="1" class="quantity-input">
                    <button type="button" id="quantity-plus">+</button>
                </div>
                
                <div class="product-actions">
                    <button id="add-to-cart-btn" class="btn-primary" data-product-id="<?php echo $product['product_id']; ?>" style="width: 100%; padding: 1rem; font-size: 1.1rem; margin-bottom: 1rem;">
                        Thêm vào giỏ hàng
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>
