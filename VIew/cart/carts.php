<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // hoặc login.php
    exit;
}
include("../connect.php");

$user_id = $_SESSION['user_id'] ?? 1; 

$sql = "SELECT * FROM cart WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <title>Giỏ hàng</title>
  <style>
    body { background: #2b2b2b; color: white; font-family: Arial; }
    .navbar { background: #ccc; padding: 10px 20px; display: flex; justify-content: space-between; align-items: center; }
    .navbar a { color: black; font-weight: bold; margin: 0 10px; text-decoration: none; }
    .navbar i { font-size: 20px; margin-left: 10px; }

    .container { display: flex; flex-wrap: wrap; padding: 40px; }
    .product-box {
      background: #3a3a3a; border: 1px solid #999;
      margin: 10px; padding: 20px; width: 300px; display: flex;
    }
    .product-box img { width: 100px; margin-right: 20px; }

    .price-box {
      background: #3a3a3a; padding: 20px;
      width: 300px; margin: 10px;
    }
    .checkout-btn {
      margin-top: 15px; padding: 10px;
      background: #ccc; border: none;
      font-weight: bold; opacity: 0.6;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<div class="navbar">
  <div><img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg" width="30"></div>
  <div>
    <a href="../upload_image/index.php">MEN</a>
  </div>
  <div>
    <i class="fa-solid fa-cart-shopping"></i>
    <i class="fa-solid fa-user"></i>
  </div>
</div>

<div class="container">
  <?php
  $total = 0;
  $shipping = 0;

  while ($row = $result->fetch_assoc()):
    $total += $row['price'];
  ?>
    <div class="product-box">
      <img src="<?= $row['image_url'] ?>" alt="Ảnh sản phẩm">
      <div>
        <p><strong>TÊN SẢN PHẨM:</strong> <?= $row['product_name'] ?></p>
        <p><strong>SỐ TIỀN:</strong> <?= number_format($row['price'], 0, ',', '.') ?>đ</p>
      </div>
    </div>
  <?php endwhile; ?>

  <!-- Tổng tiền -->
  <div class="price-box">
    <p>TIỀN SẢN PHẨM: <?= number_format($total, 0, ',', '.') ?>đ</p>
    <p>PHÍ VẬN CHUYỂN: <?= number_format($shipping, 0, ',', '.') ?>đ</p>
    <p><strong>TỔNG TIỀN: <?= number_format($total + $shipping, 0, ',', '.') ?>đ</strong></p>
    <button class="checkout-btn" disabled>CHECK OUT</button>
  </div>
</div>

</body>
</html>
