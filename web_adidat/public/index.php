<?php
$page_title = 'Trang chủ';
require_once '../includes/header.php';

//Nếu chưa đăng nhập mà có cookie thì gán vào session
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}

// Nếu vẫn chưa đăng nhập thì quay về trang đăng nhập
// if (!isset($_SESSION['username'])) {
//     header("Location: login.php");
//     exit();
// }
// Sản phẩm nổi bật
$featured_products = getProductsByCategory($pdo, null, 8);
?>

<main>
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>IMPOSSIBLE IS NOTHING</h1>
            <p>Khám phá bộ sưu tập mới nhất từ A Đi Đát</p>
            <a href="category.php?id=1" class="btn">Mua sắm ngay</a>
        </div>
    </section>
    
    <!-- Featured Products -->
    <section class="products-section">
        <div class="container">
            <h2 class="section-title">Sản phẩm nổi bật</h2>
            <div class="products-grid">
                <?php foreach ($featured_products as $product): ?>
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
        </div>
    </section>
    
    <!-- Categories Section -->
    <section class="categories-section" style="background: #f8f9fa; padding: 4rem 0;">
        <div class="container">
            <h2 class="section-title">Danh mục sản phẩm</h2>
            <div class="categories-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                <?php foreach ($categories as $category): ?>
                <div class="category-card" style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <div style="padding: 2rem; text-align: center;">
                        <h3 style="font-size: 1.5rem; margin-bottom: 1rem;"><?php echo htmlspecialchars($category['category_name']); ?></h3>
                        <a href="category.php?id=<?php echo $category['category_id']; ?>" class="btn-secondary">Xem sản phẩm</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<?php require_once '../includes/footer.php'; ?>