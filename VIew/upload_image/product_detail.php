<?php
include("../connect.php");

// Lấy id và loại sản phẩm từ URL
$id = $_GET['id'] ?? null;
$type = $_GET['type'] ?? 'shoes'; // mặc định là shoes

if (!$id) {
    die("Không có ID sản phẩm");
}

// Truy vấn đúng bảng (shoes hoặc clothing)
if ($type === 'clothing') {
    $sql = "SELECT * FROM clothing WHERE id = ?";
} else {
    $sql = "SELECT * FROM shoes WHERE id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Không tìm thấy sản phẩm");
}
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // hoặc login.php
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Chi tiết sản phẩm</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      background: #2b2b2b;
      color: white;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background: #ccc;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .navbar a {
      color: black;
      font-weight: bold;
      margin: 0 10px;
      text-decoration: none;
    }

    .container {
      background: #3a3a3a;
      padding: 30px;
      max-width: 800px;
      margin: 50px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }

    .container img {
      width: 250px;
      max-width: 100%;
      height: auto;
      border-radius: 10px;
    }

    .info {
      flex: 1;
      min-width: 250px;
    }

    .info p {
      margin: 10px 0;
      word-break: break-word;
    }

    .btn {
      padding: 10px 20px;
      background: #444;
      color: white;
      border: none;
      cursor: pointer;
      margin-top: 10px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #555;
    }

    @media (max-width: 600px) {
      .container {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }

      .info {
        text-align: left;
      }
    }
  </style>
</head>
<body>

<div class="navbar">
  <div><img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg" width="30"></div>
  <div>
    <a href="index.php">MEN</a>
  </div>
  <div>
    <a href="../cart/carts.php">🛒</a>  
    <a href="#">👤</a>
  </div>
</div>

<div class="container">
  <img src="<?= $product['image_url'] ?>" alt="Sản phẩm">
  <div class="info">
    <p><strong>TÊN SẢN PHẨM:</strong> <?= htmlspecialchars($product['name']) ?></p>
    <p><strong>SỐ TIỀN:</strong> <?= number_format($product['price'], 0, ',', '.') ?>đ</p>
    <form method="POST" action="add_to_cart.php">
  <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
  <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
  <input type="hidden" name="price" value="<?= $product['price'] ?>">
  <input type="hidden" name="image_url" value="<?= htmlspecialchars($product['image_url']) ?>">
  <button type="submit" class="btn">ADD TO BAG</button>
</form>
  </div>
</div>


</body>
</html>
