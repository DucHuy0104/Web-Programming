<?php
function formatPrice($price) {
    return number_format($price, 0, ',', '.') . ' ₫';
}

function getCategories($pdo) {
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY category_name");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByCategory($pdo, $category_id = null, $limit = null) {
    $sql = "SELECT p.*, c.category_name FROM products p 
            LEFT JOIN categories c ON p.category_id = c.category_id";
    
    if ($category_id) {
        $sql .= " WHERE p.category_id = :category_id";
    }
    
    $sql .= " ORDER BY p.product_id DESC";
    
    if ($limit) {
        $sql .= " LIMIT :limit";
    }
    
    $stmt = $pdo->prepare($sql);
    
    if ($category_id) {
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    }
    
    if ($limit) {
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    }
    
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT p.*, c.category_name FROM products p 
                          LEFT JOIN categories c ON p.category_id = c.category_id 
                          WHERE p.product_id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProductSizes($pdo, $product_id) {
    $stmt = $pdo->prepare("SELECT size_value FROM product_size WHERE product_id = ? ORDER BY size_value");
    $stmt->execute([$product_id]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function addToCart($product_id, $size, $quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $key = $product_id . '_' . $size;
    
    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['quantity'] += $quantity;
    } else {
        $_SESSION['cart'][$key] = [
            'product_id' => $product_id,
            'size' => $size,
            'quantity' => $quantity
        ];
    }
}

function getCartItems($pdo) {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        return [];
    }
    
    $items = [];
    foreach ($_SESSION['cart'] as $key => $item) {
        $product = getProductById($pdo, $item['product_id']);
        if ($product) {
            $items[] = [
                'key' => $key,
                'product' => $product,
                'size' => $item['size'],
                'quantity' => $item['quantity'],
                'total' => $product['price'] * $item['quantity']
            ];
        }
    }
    
    return $items;
}

function getCartTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['total'];
    }
    return $total;
}
?>