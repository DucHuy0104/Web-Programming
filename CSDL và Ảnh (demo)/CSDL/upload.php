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

// Lưu vào DB
foreach ($data as $product) {
    $name = $conn->real_escape_string($product['name']);
    $price = $product['price'];
    $image_url = $conn->real_escape_string($product['image_url']);

    $sql = "INSERT INTO products (name, price, image_url)
            VALUES ('$name', $price, '$image_url')";

    if (!$conn->query($sql)) {
        echo "❌ Lỗi: " . $conn->error;
        exit;
    }
}

echo "✅ Đã lưu " . count($data) . " sản phẩm vào MySQL";
$conn->close();
?>
