# Web Adidat - E-Commerce Platform

## Project Overview
Web Adidat là một nền tảng thương mại điện tử được xây dựng bằng PHP và MySQL. Ứng dụng cung cấp các tính năng quản lý sản phẩm, danh mục, người dùng, và xử lý đơn hàng cho cả khách hàng và quản trị viên.

### Mục tiêu dự án
- Cung cấp giao diện thân thiện cho khách hàng mua sắm trực tuyến
- Cung cấp hệ thống quản lý toàn diện cho quản trị viên
- Xử lý thanh toán và quản lý đơn hàng hiệu quả
- Quản lý danh mục sản phẩm linh hoạt

---

## Business Requirements
### Yêu cầu chức năng
1. **Quản lý sản phẩm**
   - Thêm, sửa, xóa sản phẩm
   - Hiển thị sản phẩm theo danh mục
   - Tìm kiếm sản phẩm

2. **Quản lý danh mục**
   - Tạo và quản lý danh mục sản phẩm
   - Phân loại sản phẩm theo danh mục

3. **Quản lý người dùng**
   - Đăng ký và đăng nhập
   - Quản lý thông tin cá nhân
   - Phân quyền (Admin, User)

4. **Quản lý đơn hàng**
   - Thêm sản phẩm vào giỏ hàng
   - Thanh toán đơn hàng
   - Xem lịch sử đơn hàng
   - Quản lý trạng thái đơn hàng

### Yêu cầu phi chức năng
- Bảo mật: Xác thực người dùng, mã hóa mật khẩu
- Hiệu suất: Tối ưu hóa truy vấn cơ sở dữ liệu
- Độ tin cậy: Xử lý lỗi và validation dữ liệu

---

## Actors
1. **Guest (Khách vãng lai)**
   - Xem sản phẩm
   - Đăng ký tài khoản
   - Đăng nhập

2. **Customer (Khách hàng)**
   - Xem chi tiết sản phẩm
   - Tìm kiếm sản phẩm
   - Thêm sản phẩm vào giỏ hàng
   - Thanh toán đơn hàng
   - Xem lịch sử đơn hàng
   - Cập nhật thông tin cá nhân
   - Đăng xuất

3. **Admin (Quản trị viên)**
   - Quản lý sản phẩm (CRUD)
   - Quản lý danh mục (CRUD)
   - Quản lý người dùng (CRUD)
   - Quản lý đơn hàng
   - Xem báo cáo doanh số

---

## Use Cases

### UC1: Khách hàng mua sắm sản phẩm
- **Actor:** Customer
- **Tiên điều kiện:** Khách hàng đã đăng nhập
- **Các bước:**
  1. Khách hàng xem danh sách sản phẩm
  2. Tìm kiếm hoặc lọc sản phẩm theo danh mục
  3. Xem chi tiết sản phẩm
  4. Thêm sản phẩm vào giỏ hàng
  5. Tiến hành thanh toán
  6. Xác nhận đơn hàng

### UC2: Quản trị viên quản lý sản phẩm
- **Actor:** Admin
- **Tiên điều kiện:** Admin đã đăng nhập
- **Các bước:**
  1. Admin truy cập trang quản lý sản phẩm
  2. Xem danh sách sản phẩm hiện có
  3. Thêm sản phẩm mới, sửa hoặc xóa sản phẩm
  4. Cập nhật thông tin sản phẩm (giá, mô tả, hình ảnh)

### UC3: Khách hàng đăng ký tài khoản
- **Actor:** Guest
- **Tiên điều kiện:** Không cần đăng nhập
- **Các bước:**
  1. Khách hàng truy cập trang đăng ký
  2. Nhập thông tin cá nhân
  3. Chọn mật khẩu
  4. Xác nhận đăng ký
  5. Tài khoản được tạo thành công

### UC4: Quản trị viên quản lý đơn hàng
- **Actor:** Admin
- **Tiên điều kiện:** Admin đã đăng nhập
- **Các bước:**
  1. Admin xem danh sách đơn hàng
  2. Xem chi tiết đơn hàng
  3. Cập nhật trạng thái đơn hàng

---

## User Flow

### Customer User Flow
```
Trang chủ → Xem sản phẩm → Tìm kiếm/Lọc
    ↓
Chi tiết sản phẩm
    ↓
Thêm vào giỏ hàng
    ↓
Xem giỏ hàng → Cập nhật số lượng
    ↓
Thanh toán
    ↓
Xác nhận đơn hàng
    ↓
Lịch sử đơn hàng
```

### Admin User Flow
```
Đăng nhập Admin → Trang Dashboard
    ↓
├── Quản lý sản phẩm (Thêm/Sửa/Xóa)
├── Quản lý danh mục (Thêm/Sửa/Xóa)
├── Quản lý người dùng (Thêm/Sửa/Xóa)
├── Quản lý đơn hàng (Xem/Cập nhật)
└── Đăng xuất
```

---

## System Architecture

### Kiến trúc tổng quát
```
┌─────────────────────────────────────────┐
│         Presentation Layer              │
│  (Public Web Interface / Admin Panel)   │
└──────────────────┬──────────────────────┘
                   │
┌──────────────────▼──────────────────────┐
│      Business Logic Layer               │
│  (PHP Files & Functions)                │
└──────────────────┬──────────────────────┘
                   │
┌──────────────────▼──────────────────────┐
│        Data Access Layer                │
│  (Database Connection & Queries)        │
└──────────────────┬──────────────────────┘
                   │
┌──────────────────▼──────────────────────┐
│        Database Layer (MySQL)           │
└─────────────────────────────────────────┘
```

### Cấu trúc thư mục
- **public/**: Giao diện người dùng (Khách hàng)
- **admin/**: Giao diện quản trị
- **includes/**: Các file cấu hình và hàm chung
- **uploads/**: Lưu trữ hình ảnh sản phẩm

### Công nghệ sử dụng
- **Backend:** PHP
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript
- **Framework/Library:** Không sử dụng framework (Vanilla PHP)

---

## Database / ERD

### Entities

#### 1. users (Người dùng)
| Column | Type | Constraint | Mô tả |
|--------|------|-----------|-------|
| user_id | INT | PRIMARY KEY | ID người dùng |
| username | VARCHAR(50) | UNIQUE, NOT NULL | Tên đăng nhập |
| email | VARCHAR(100) | UNIQUE, NOT NULL | Email |
| password | VARCHAR(255) | NOT NULL | Mật khẩu (hash) |
| full_name | VARCHAR(100) | | Tên đầy đủ |
| phone | VARCHAR(15) | | Số điện thoại |
| address | TEXT | | Địa chỉ |
| role | ENUM('admin', 'user') | DEFAULT 'user' | Vai trò |
| created_at | TIMESTAMP | DEFAULT NOW() | Ngày tạo |
| updated_at | TIMESTAMP | | Ngày cập nhật |

#### 2. categories (Danh mục)
| Column | Type | Constraint | Mô tả |
|--------|------|-----------|-------|
| category_id | INT | PRIMARY KEY | ID danh mục |
| category_name | VARCHAR(100) | NOT NULL | Tên danh mục |
| description | TEXT | | Mô tả |
| created_at | TIMESTAMP | DEFAULT NOW() | Ngày tạo |

#### 3. products (Sản phẩm)
| Column | Type | Constraint | Mô tả |
|--------|------|-----------|-------|
| product_id | INT | PRIMARY KEY | ID sản phẩm |
| category_id | INT | FOREIGN KEY | ID danh mục |
| product_name | VARCHAR(150) | NOT NULL | Tên sản phẩm |
| description | TEXT | | Mô tả |
| price | DECIMAL(10,2) | NOT NULL | Giá |
| quantity | INT | DEFAULT 0 | Số lượng |
| image | VARCHAR(255) | | Đường dẫn hình ảnh |
| created_at | TIMESTAMP | DEFAULT NOW() | Ngày tạo |
| updated_at | TIMESTAMP | | Ngày cập nhật |

#### 4. orders (Đơn hàng)
| Column | Type | Constraint | Mô tả |
|--------|------|-----------|-------|
| order_id | INT | PRIMARY KEY | ID đơn hàng |
| user_id | INT | FOREIGN KEY | ID người dùng |
| total_amount | DECIMAL(10,2) | NOT NULL | Tổng tiền |
| status | ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') | DEFAULT 'pending' | Trạng thái |
| order_date | TIMESTAMP | DEFAULT NOW() | Ngày đặt hàng |
| delivery_date | TIMESTAMP | | Ngày giao hàng |

#### 5. order_items (Chi tiết đơn hàng)
| Column | Type | Constraint | Mô tả |
|--------|------|-----------|-------|
| order_item_id | INT | PRIMARY KEY | ID chi tiết đơn |
| order_id | INT | FOREIGN KEY | ID đơn hàng |
| product_id | INT | FOREIGN KEY | ID sản phẩm |
| quantity | INT | NOT NULL | Số lượng |
| unit_price | DECIMAL(10,2) | NOT NULL | Giá đơn vị |
| total_price | DECIMAL(10,2) | NOT NULL | Tổng tiền |

### Entity Relationship Diagram (ERD)
```
┌──────────────────┐
│     USERS        │
├──────────────────┤
│ user_id (PK)     │
│ username         │
│ email            │
│ password         │
│ full_name        │
│ phone            │
│ address          │
│ role             │
│ created_at       │
└────────┬─────────┘
         │ 1
         │
         │ N
    ┌────▼─────────────┐
    │     ORDERS       │
    ├──────────────────┤
    │ order_id (PK)    │
    │ user_id (FK)     │
    │ total_amount     │
    │ status           │
    │ order_date       │
    │ delivery_date    │
    └────┬─────────────┘
         │ 1
         │
         │ N
    ┌────▼────────────────────┐
    │   ORDER_ITEMS          │
    ├────────────────────────┤
    │ order_item_id (PK)     │
    │ order_id (FK)          │
    │ product_id (FK) ────────┐
    │ quantity               │ N
    │ unit_price             │
    │ total_price            │
    └────────────────────────┘
                              │
                              │ 1
                              │
                    ┌─────────▼───────────┐
                    │   PRODUCTS          │
                    ├─────────────────────┤
                    │ product_id (PK)     │
                    │ category_id (FK) ───┐
                    │ product_name        │ N
                    │ description         │
                    │ price               │
                    │ quantity            │
                    │ image               │
                    │ created_at          │
                    └─────────────────────┘
                              ▲
                              │ 1
                              │
                    ┌─────────┴───────────┐
                    │   CATEGORIES        │
                    ├─────────────────────┤
                    │ category_id (PK)    │
                    │ category_name       │
                    │ description         │
                    │ created_at          │
                    └─────────────────────┘
```

---

## Screenshots

### Trang khách hàng
- **Trang chủ:** Hiển thị sản phẩm nổi bật, banner quảng cáo
- **Danh sách sản phẩm:** Hiển thị các sản phẩm theo danh mục, tìm kiếm
- **Chi tiết sản phẩm:** Hiển thị thông tin chi tiết, hình ảnh, giá
- **Giỏ hàng:** Xem, cập nhật số lượng sản phẩm trong giỏ
- **Thanh toán:** Form nhập thông tin giao hàng và xác nhận
- **Lịch sử đơn hàng:** Xem các đơn hàng đã đặt

### Trang quản trị
- **Dashboard:** Tóm tắt thống kê
- **Quản lý sản phẩm:** Danh sách, thêm, sửa, xóa sản phẩm
- **Quản lý danh mục:** Quản lý các danh mục sản phẩm
- **Quản lý người dùng:** Quản lý tài khoản khách hàng
- **Quản lý đơn hàng:** Xem và cập nhật trạng thái đơn hàng

*Lưu ý: Thêm các hình ảnh thực tế của ứng dụng vào đây*

---

## Installation

### Yêu cầu hệ thống
- PHP >= 7.4
- MySQL >= 5.7 (hoặc MariaDB >= 10.3)
- Web server (Apache, Nginx, v.v.)
- Composer (tùy chọn)

### Hướng dẫn cài đặt

#### Bước 1: Clone repository
```bash
git clone https://github.com/DucHuy0104/Web-Programming.git
cd web_adidat
```

#### Bước 2: Cập nhật thông tin database
1. Mở file `includes/db.php`
2. Cấu hình thông tin kết nối database:
```php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'web_adidat';
```

#### Bước 3: Import database
1. Tạo database mới tên `web_adidat`:
```bash
mysql -u root -p < web_adidat.sql
```

Hoặc sử dụng phpMyAdmin:
- Mở phpMyAdmin
- Tạo database `web_adidat`
- Import file `web_adidat.sql`

#### Bước 4: Cấu hình web server

**Với Apache:**
- Đảm bảo mod_rewrite được bật
- Đặt document root trỏ tới thư mục `web_adidat`
- Tạo file `.htaccess` nếu cần thiết

**Với Nginx:**
- Cấu hình server block trỏ tới thư mục `web_adidat`

#### Bước 5: Cấp quyền thư mục
```bash
chmod 755 -R web_adidat/
chmod 777 -R web_adidat/uploads/
```

#### Bước 6: Truy cập ứng dụng

**Khách hàng:**
```
http://localhost/public/
```

**Quản trị viên:**
```
http://localhost/admin/
```

### Tài khoản mặc định
- **Admin:**
  - Username: `admin`
  - Password: `admin123`

- **Khách hàng test:**
  - Username: `customer`
  - Password: `customer123`

### Khắc phục sự cố

**Lỗi: Cannot connect to database**
- Kiểm tra thông tin kết nối trong `includes/db.php`
- Đảm bảo MySQL đang chạy
- Kiểm tra tên database và người dùng MySQL

**Lỗi: 404 Not Found**
- Kiểm tra cấu hình web server
- Kiểm tra đường dẫn file
- Xóa cache trình duyệt

**Lỗi: Permission denied (uploads)**
- Cấp quyền write cho thư mục `uploads/`: `chmod 777 uploads/`

---

## Liên hệ
- Email: [your-email@example.com]
- Github: [https://github.com/DucHuy0104/Web-Programming]

---

**Phiên bản:** 1.0.0  
**Ngày cập nhật:** 2026-08-17  
**License:** MIT
