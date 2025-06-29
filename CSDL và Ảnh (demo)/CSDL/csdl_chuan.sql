-- SQL chuẩn hóa dựa theo adidas.sql
-- Tạo bảng categories
CREATE TABLE IF NOT EXISTS categories (
  category_id INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(50) NOT NULL UNIQUE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tạo bảng products
CREATE TABLE IF NOT EXISTS products (
  product_id INT AUTO_INCREMENT PRIMARY KEY,
  product_name VARCHAR(100) NOT NULL,
  description TEXT DEFAULT NULL,
  price DECIMAL(10,2) NOT NULL,
  image_url VARCHAR(255) DEFAULT NULL,
  category_id INT DEFAULT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tạo bảng orders
CREATE TABLE IF NOT EXISTS orders (
  order_id INT AUTO_INCREMENT PRIMARY KEY,
  order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  customer_name VARCHAR(50) NOT NULL,
  phone_number VARCHAR(15) NOT NULL,
  email VARCHAR(320) NOT NULL,
  city VARCHAR(50) NOT NULL,
  district VARCHAR(50) NOT NULL,
  address VARCHAR(255) NOT NULL,
  note VARCHAR(255) DEFAULT NULL,
  status VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tạo bảng order_details
CREATE TABLE IF NOT EXISTS order_details (
  order_detail_id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT DEFAULT NULL,
  product_id INT DEFAULT NULL,
  size_value INT NOT NULL,
  quantity INT NOT NULL,
  unit_price DECIMAL(10,2) NOT NULL,
  FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tạo bảng product_size
CREATE TABLE IF NOT EXISTS product_size (
  product_size_id INT AUTO_INCREMENT PRIMARY KEY,
  product_id INT DEFAULT NULL,
  size_value INT DEFAULT NULL,
  FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Thêm dữ liệu mẫu cho categories
INSERT INTO categories (category_name) VALUES ('Áo'), ('Quần'), ('Giày'), ('Phụ kiện')
  ON DUPLICATE KEY UPDATE category_name=category_name;

-- Thêm dữ liệu mẫu cho products (với tên file ảnh thực tế từ SQLWen_files)
INSERT INTO products (product_name, price, image_url, category_id) VALUES
('Áo thun adizero running', 99.99, 'SQLWen_files/adizero-running-tee.jpg', 1),
('Quần ngắn 90s football', 129.99, 'SQLWen_files/90s-football-short.jpg', 2),
('Áo khoác multi essentials', 109.99, 'SQLWen_files/multi-essentials-2l-rain-jacket.jpg', 1),
('Giày thể thao nam', 119.99, 'SQLWen_files/BB_5478_SL_e_Com_Gazelle_Final_1_b4004777e0.jpeg', 3),
('Giày thể thao nữ', 139.99, 'SQLWen_files/IF_3814_SL_e_Com_Samba_Final_1_3ea3064d53.jpeg', 3),
('Áo thể thao badge graphic', 89.99, 'SQLWen_files/badge-graphic-tee.jpg', 1); 