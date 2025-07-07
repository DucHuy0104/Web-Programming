<?php
require_once 'db.php';
require_once 'functions.php';
$categories = getCategories($pdo);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>A Đi Đát</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .dropdown {
        display: none;
        position: absolute;
        background-color: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        z-index: 1;
        }
        .dropdown a {
        display: block;
        padding: 10px;
        text-decoration: none;
        color: black;
        }
        .dropdown a:hover {
        background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="index.php">
                        <img src="assets/images/" alt="A Đi Đát" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <span style="display:none; font-weight:bold; font-size:24px;text-decoration:none">A Đi Đát</span>
                    </a>
                </div>
                
                <nav class="main-nav">
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <?php foreach ($categories as $category): ?>
                        <li><a href="category.php?id=<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
                
                <div class="header-actions">
                    <div class="search-box">
                        <form action="search.php" method="GET">
                            <input type="text" name="q" placeholder="Tìm kiếm sản phẩm...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    
                    <div class="user-menu">
                        <?php if (isLoggedIn()): ?>
                            <a href="#" class="user-icon" onclick="toggleDropdown(event);"><i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                            <div class="dropdown" id="user-dropdown">
                                <a href="profile.php">Quản lý thông tin</a>
                                <a href="order_history.php">Lịch sử mua hàng</a>
                                
                                <a href="logout.php">Đăng xuất</a>
                                <?php if (isAdmin()): ?>
                                    <a href="../admin/">Quản trị</a>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <a href="login.php" class="user-icon"><i class="fas fa-user"></i> Đăng nhập</a>
                        <?php endif; ?>
                    </div>
                    
                    <div class="cart-icon">
                        <a href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count"><?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script>
    function toggleDropdown(event) {
        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết
        var dropdown = document.getElementById('user-dropdown');
        dropdown.style.display = dropdown.style.display === 'none' || dropdown.style.display === '' ? 'block' : 'none';
    }

    // Đóng dropdown nếu người dùng nhấp ra ngoài
    window.onclick = function(event) {
        if (!event.target.matches('.user-icon')) {
            var dropdowns = document.getElementsByClassName("dropdown");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === 'block') {
                    openDropdown.style.display = 'none';
                }
            }
        }
    }
    </script>
</body>
</html>
