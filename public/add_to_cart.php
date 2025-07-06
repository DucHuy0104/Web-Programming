<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = (int)($_POST['product_id'] ?? 0);
    $size = $_POST['size'] ?? '';
    $quantity = (int)($_POST['quantity'] ?? 1);
    
    if ($product_id > 0 && !empty($size) && $quantity > 0) {
        addToCart($product_id, $size, $quantity);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>