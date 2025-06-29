<?php
// Kết nối MySQL (XAMPP)
$host = "localhost";
$user = "root";
$password = "";
$dbname = "fashion_shop";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu JSON
$data = json_decode(file_get_contents("php://input"), true);

// Lưu vào DB với cấu trúc bảng mới
foreach ($data as $product) {
    $name = $conn->real_escape_string($product['name']);
    $price = $product['price'];
    $image_url = $conn->real_escape_string($product['image_url']);
    
    // Thêm description mặc định nếu không có
    $description = isset($product['description']) ? $conn->real_escape_string($product['description']) : '';
    
    // Thêm category_id mặc định (1 = Áo) nếu không có
    $category_id = isset($product['category_id']) ? $product['category_id'] : 1;

    $sql = "INSERT INTO products (product_name, description, price, image_url, category_id)
            VALUES ('$name', '$description', $price, '$image_url', $category_id)";

    if (!$conn->query($sql)) {
        echo "❌ Lỗi: " . $conn->error;
        exit;
    }
}

echo "✅ Đã lưu " . count($data) . " sản phẩm vào MySQL với cấu trúc bảng mới";
$conn->close();
?>
