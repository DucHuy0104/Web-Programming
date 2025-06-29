<?php
$mysqli = new mysqli("localhost", "root", "", "users");
if ($mysqli->connect_errno) {
    die("Lỗi kết nối MySQL: " . $mysqli->connect_error);
}

$products = [];
$sql_shoes = "SELECT id, name, price, image_url, 'shoes' AS category FROM shoes";
$sql_clothing = "SELECT id, name, price, image_url, 'clothing' AS category FROM clothing";

$shoes = $mysqli->query($sql_shoes);
$clothing = $mysqli->query($sql_clothing);

while ($row = $shoes->fetch_assoc()) $products[] = $row;
while ($row = $clothing->fetch_assoc()) $products[] = $row;
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html"); // hoặc login.php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sản phẩm</title>
    <style>
        * {
            font-family: sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }

        .navbar {
            background: #222;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar span {
            cursor: pointer;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .navbar span:hover {
            color: #ccc;
        }

        .sub-menu {
            display: none;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            background-color: #333;
            animation: fadeIn 0.4s ease-in-out;
        }

        .sub-menu button {
            padding: 8px 16px;
            border: none;
            background-color: #555;
            color: white;
            cursor: pointer;
            border-radius: 4px;
            transition: background 0.3s, transform 0.2s;
        }

        .sub-menu button:hover {
            background-color: #777;
            transform: scale(1.05);
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            padding: 20px;
            opacity: 0;
            animation: fadeIn 0.8s forwards;
        }

        .product-card {
            border: 1px solid #ccc;
            background: white;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
            transition: transform 0.3s;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .price {
            font-weight: bold;
            font-size: 18px;
            margin-top: 10px;
            color: #222;
        }

        .name {
            font-size: 14px;
            margin-top: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-transform: uppercase;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="navbar">
    <div><img src="icon.png" alt="Logo" height="40"></div>
    <div>
        <span onclick="toggleMenu()">MEN</span>
        <a href="../cart/carts.php">🛒</a> 
        <a href="../profile.php">👤</a>
    </div>
</div>

<div class="sub-menu" id="categoryMenu">
    <button onclick="filterCategory('clothing')">CLOTHING</button>
    <button onclick="filterCategory('shoes')">SHOES</button>
    <button onclick="filterCategory('all')">TẤT CẢ</button>
</div>
<div class="products" id="productList">
    <?php foreach ($products as $product): ?>
        <a href="product_detail.php?id=<?= $product['id'] ?>&type=<?= $product['category'] ?>" style="text-decoration: none; color: inherit;">


            <div class="product-card" data-category="<?= $product['category']; ?>">
                <img src="<?= $product['image_url']; ?>" alt="Product">
                <div class="price"><?= number_format($product['price'], 0, ',', '.'); ?> ₫</div>
                <div class="name"><?= $product['name']; ?></div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<script>
let menuVisible = false;

function toggleMenu() {
    const menu = document.getElementById('categoryMenu');
    menuVisible = !menuVisible;
    menu.style.display = menuVisible ? 'flex' : 'none';
}

function filterCategory(category) {
    const items = document.querySelectorAll('.product-card');
    items.forEach(item => {
        if (category === 'all') {
            item.style.display = 'block';
        } else {
            item.style.display = item.dataset.category === category ? 'block' : 'none';
        }
    });
}
</script>

</body>
</html>
