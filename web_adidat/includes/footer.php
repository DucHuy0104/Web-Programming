<footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Sản phẩm</h3>
                    <ul>
                        <?php foreach ($categories as $category): ?>
                        <li><a href="category.php?id=<?php echo $category['category_id']; ?>"><?php echo htmlspecialchars($category['category_name']); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Hỗ trợ</h3>
                    <ul>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="#">Hướng dẫn mua hàng</a></li>
                        <li><a href="#">Chính sách đổi trả</a></li>
                        <li><a href="#">Bảo hành</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Về A Đi Đát</h3>
                    <ul>
                        <li><a href="#">Giới thiệu</a></li>
                        <li><a href="#">Tin tức</a></li>
                        <li><a href="#">Tuyển dụng</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h3>Kết nối với chúng tôi</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/adidas"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/adidas"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/adidas"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 A Đi Đát Vietnam. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="assets/js/main.js"></script>
</body>
</html>