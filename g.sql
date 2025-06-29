<<<<<<< HEAD
-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS users;
USE users;

-- Tạo bảng người dùng (không dùng từ khóa 'user' mà đổi thành 'users')
CREATE TABLE IF NOT EXISTS user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL
);

-- Tạo bảng giỏ hàng, có khóa ngoại tới bảng users
CREATE TABLE IF NOT EXISTS cart (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Tạo bảng giày (shoes)
CREATE TABLE IF NOT EXISTS shoes (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

-- Thêm dữ liệu giày
INSERT INTO shoes (id, name, price, image_url) VALUES
(1, 'dep-adilette-lumia', 180000.00, 'uploads/dep-adilette-lumia.jpg'),
(2, 'dep-adilette', 170000.00, 'uploads/dep-adilette.jpg'),
(3, 'Dep_Adilette_Shower_Manchester_United_DJen_JS4963', 250000.00, 'uploads/Dep_Adilette_Shower_Manchester_United_DJen_JS4963.jpg'),
(4, 'Dep_Sandal_ZNSORY_DJen_JR3122', 220000.00, 'uploads/Dep_Sandal_ZNSORY_DJen_JR3122.jpg'),
(5, 'Dep_Suc_adilette_Mau_xanh_da_troi_JI2241', 200000.00, 'uploads/Dep_Suc_adilette_Mau_xanh_da_troi_JI2241.jpg'),
(6, 'doi-giay-adizero-boston-13', 1500000.00, 'uploads/doi-giay-adizero-boston-13.jpg'),
(7, 'giay-adizero-boston-13', 1450000.00, 'uploads/giay-adizero-boston-13.jpg'),
(8, 'giay-adizero-evo-sl', 1600000.00, 'uploads/giay-adizero-evo-sl.jpg'),
(9, 'giay-chay-bo-duramo-rc2', 850000.00, 'uploads/giay-chay-bo-duramo-rc2.jpg'),
(10, 'giay-cloudfoam-walk-lounger', 700000.00, 'uploads/giay-cloudfoam-walk-lounger.jpg'),
(11, 'giay-y-3-regu-2002', 2800000.00, 'uploads/giay-y-3-regu-2002.jpg'),
(12, 'Giay_Samba_OG', 1300000.00, 'uploads/Giay_Samba_OG.jpg'),
(13, 'IF_3814_SL_e_Com_Samba_Final_1_3ea3064d53', 1250000.00, 'uploads/IF_3814_SL_e_Com_Samba_Final_1_3ea3064d53.jpeg'),
(14, 'IF_8766_SL_e_Com_Campus_Final_1_190b910618', 1100000.00, 'uploads/IF_8766_SL_e_Com_Campus_Final_1_190b910618.jpeg'),
(15, 'IG_6192_SL_e_Com_Spezial_Final_1_85010da875', 1050000.00, 'uploads/IG_6192_SL_e_Com_Spezial_Final_1_85010da875.jpeg'),
(16, 'IH_8659_SLC_e_Com_516x240px_bb3ef1284f', 900000.00, 'uploads/IH_8659_SLC_e_Com_516x240px_bb3ef1284f.jpg');

-- Tạo bảng quần áo
CREATE TABLE IF NOT EXISTS clothing (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

-- Thêm dữ liệu quần áo
INSERT INTO clothing (id, name, price, image_url) VALUES
(1, 'adi365-h.koumori-running-tee-gender-neutral', 1290000, 'SQLWen_files/adi365-h.koumori-running-tee-gender-neutral.jpg'),
(2, 'adizero-archive-running-singlet(1)', 850000, 'SQLWen_files/adizero-archive-running-singlet(1).jpg'),
(3, 'adizero-archive-running-singlet', 950000, 'SQLWen_files/adizero-archive-running-singlet.jpg'),
(4, 'adizero-essentials-running-singlet', 790000, 'SQLWen_files/adizero-essentials-running-singlet.jpg'),
(5, 'adizero-running-tee(1)', 990000, 'SQLWen_files/adizero-running-tee(1).jpg'),
(6, 'adizero-running-tee', 1100000, 'SQLWen_files/adizero-running-tee.jpg'),
(7, 'adizero-running-vest', 880000, 'SQLWen_files/adizero-running-vest.jpg'),
(8, 'archive-cutline-tee', 1120000, 'SQLWen_files/archive-cutline-tee.jpg'),
(10, 'club-tennis-polo-shirt', 1090000, 'SQLWen_files/club-tennis-polo-shirt.jpg'),
(9, 'badge-graphic-tee', 1250000, 'SQLWen_files/badge-graphic-tee.jpg'),
(11, 'collared-goalie-top(1)', 1180000, 'SQLWen_files/collared-goalie-top(1).jpg'),
(12, 'collared-goalie-top(2)', 1190000, 'SQLWen_files/collared-goalie-top(2).jpg'),
(13, 'collared-goalie-top', 1170000, 'SQLWen_files/collared-goalie-top.jpg'),
(14, 'd4t-x-sleeveless-tee', 920000, 'SQLWen_files/d4t-x-sleeveless-tee.jpg'),
(15, 'dog-soccer-patch-pocket-graphic-tee(1)', 880000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(1).jpg'),
(16, 'dog-soccer-patch-pocket-graphic-tee(2)', 860000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(2).jpg'),
(17, 'dog-soccer-patch-pocket-graphic-tee(3)', 890000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(3).jpg'),
(18, 'dog-soccer-patch-pocket-graphic-tee', 930000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee.jpg'),
(19, 'dog-sock-patch-graphic-tee(1)', 890000, 'SQLWen_files/dog-sock-patch-graphic-tee(1).jpg'),
(20, 'dog-sock-patch-graphic-tee', 910000, 'SQLWen_files/dog-sock-patch-graphic-tee.jpg'),
(21, 'juventus-25-26-away-jersey', 1500000, 'SQLWen_files/juventus-25-26-away-jersey.jpg'),
(22, 'manchester-united-25-26-home-jersey', 1550000, 'SQLWen_files/manchester-united-25-26-home-jersey.jpg'),
(23, 'mercedes---amg-petronas-formula-one-team-driver-jersey-authentic', 1900000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-driver-jersey-authentic.jpg'),
(24, 'mercedes---amg-petronas-formula-one-team-george-russell-tee', 1350000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-george-russell-tee.jpg'),
(25, 'mercedes---amg-petronas-formula-one-team-polo(2)', 1250000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-polo(2).jpg'),
(26, 'mercedes---amg-petronas-formula-one-team-polo', 1200000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-polo.jpg'),
(27, 'messi-graphic-tee(1)', 950000, 'SQLWen_files/messi-graphic-tee(1).jpg'),
(28, 'messi-graphic-tee(3)', 970000, 'SQLWen_files/messi-graphic-tee(3).jpg'),
(29, 'multi-essentials-2l-rain-jacket', 1480000, 'SQLWen_files/multi-essentials-2l-rain-jacket.jpg'),
(30, 'newcastle-united-fc-25-26-home-jersey', 1400000, 'SQLWen_files/newcastle-united-fc-25-26-home-jersey.jpg'),
(31, 'real-madrid-25-26-away-jersey', 1350000, 'SQLWen_files/real-madrid-25-26-away-jersey.jpg'),
(32, 'real-madrid-25-26-home-authentic-jersey', 1650000, 'SQLWen_files/real-madrid-25-26-home-authentic-jersey.jpg'),
(33, 'real-madrid-25-26-home-jersey', 1500000, 'SQLWen_files/real-madrid-25-26-home-jersey.jpg'),
(34, 'tennis-climacool-freelift-polo-shirt', 990000, 'SQLWen_files/tennis-climacool-freelift-polo-shirt.jpg'),
(35, 'tennis-graphic-tee(1)', 890000, 'SQLWen_files/tennis-graphic-tee(1).jpg'),
(36, 'tennis-graphic-tee', 910000, 'SQLWen_files/tennis-graphic-tee.jpg'),
(37, 'tennis-pro-climacool_-freelift-polo-shirt', 980000, 'SQLWen_files/tennis-pro-climacool_-freelift-polo-shirt.jpg'),
(38, 'trefoilo-essentials-polo-tee(1)', 850000, 'SQLWen_files/trefoilo-essentials-polo-tee(1).jpg'),
(39, 'trefoilo-essentials-polo-tee', 870000, 'SQLWen_files/trefoilo-essentials-polo-tee.jpg'),
(40, 'y-3-short-sleeve-tee-3-stripes', 1120000, 'SQLWen_files/y-3-short-sleeve-tee-3-stripes.jpg');
=======
-- Tạo cơ sở dữ liệu nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS users;
USE users;

-- Tạo bảng người dùng (không dùng từ khóa 'user' mà đổi thành 'users')
CREATE TABLE IF NOT EXISTS user (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL
);

-- Tạo bảng giỏ hàng, có khóa ngoại tới bảng users
CREATE TABLE IF NOT EXISTS cart (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    product_name VARCHAR(100) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    image_url TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Tạo bảng giày (shoes)
CREATE TABLE IF NOT EXISTS shoes (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

-- Thêm dữ liệu giày
INSERT INTO shoes (id, name, price, image_url) VALUES
(1, 'dep-adilette-lumia', 180000.00, 'uploads/dep-adilette-lumia.jpg'),
(2, 'dep-adilette', 170000.00, 'uploads/dep-adilette.jpg'),
(3, 'Dep_Adilette_Shower_Manchester_United_DJen_JS4963', 250000.00, 'uploads/Dep_Adilette_Shower_Manchester_United_DJen_JS4963.jpg'),
(4, 'Dep_Sandal_ZNSORY_DJen_JR3122', 220000.00, 'uploads/Dep_Sandal_ZNSORY_DJen_JR3122.jpg'),
(5, 'Dep_Suc_adilette_Mau_xanh_da_troi_JI2241', 200000.00, 'uploads/Dep_Suc_adilette_Mau_xanh_da_troi_JI2241.jpg'),
(6, 'doi-giay-adizero-boston-13', 1500000.00, 'uploads/doi-giay-adizero-boston-13.jpg'),
(7, 'giay-adizero-boston-13', 1450000.00, 'uploads/giay-adizero-boston-13.jpg'),
(8, 'giay-adizero-evo-sl', 1600000.00, 'uploads/giay-adizero-evo-sl.jpg'),
(9, 'giay-chay-bo-duramo-rc2', 850000.00, 'uploads/giay-chay-bo-duramo-rc2.jpg'),
(10, 'giay-cloudfoam-walk-lounger', 700000.00, 'uploads/giay-cloudfoam-walk-lounger.jpg'),
(11, 'giay-y-3-regu-2002', 2800000.00, 'uploads/giay-y-3-regu-2002.jpg'),
(12, 'Giay_Samba_OG', 1300000.00, 'uploads/Giay_Samba_OG.jpg'),
(13, 'IF_3814_SL_e_Com_Samba_Final_1_3ea3064d53', 1250000.00, 'uploads/IF_3814_SL_e_Com_Samba_Final_1_3ea3064d53.jpeg'),
(14, 'IF_8766_SL_e_Com_Campus_Final_1_190b910618', 1100000.00, 'uploads/IF_8766_SL_e_Com_Campus_Final_1_190b910618.jpeg'),
(15, 'IG_6192_SL_e_Com_Spezial_Final_1_85010da875', 1050000.00, 'uploads/IG_6192_SL_e_Com_Spezial_Final_1_85010da875.jpeg'),
(16, 'IH_8659_SLC_e_Com_516x240px_bb3ef1284f', 900000.00, 'uploads/IH_8659_SLC_e_Com_516x240px_bb3ef1284f.jpg');

-- Tạo bảng quần áo
CREATE TABLE IF NOT EXISTS clothing (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

-- Thêm dữ liệu quần áo
INSERT INTO clothing (id, name, price, image_url) VALUES
(1, 'adi365-h.koumori-running-tee-gender-neutral', 1290000, 'SQLWen_files/adi365-h.koumori-running-tee-gender-neutral.jpg'),
(2, 'adizero-archive-running-singlet(1)', 850000, 'SQLWen_files/adizero-archive-running-singlet(1).jpg'),
(3, 'adizero-archive-running-singlet', 950000, 'SQLWen_files/adizero-archive-running-singlet.jpg'),
(4, 'adizero-essentials-running-singlet', 790000, 'SQLWen_files/adizero-essentials-running-singlet.jpg'),
(5, 'adizero-running-tee(1)', 990000, 'SQLWen_files/adizero-running-tee(1).jpg'),
(6, 'adizero-running-tee', 1100000, 'SQLWen_files/adizero-running-tee.jpg'),
(7, 'adizero-running-vest', 880000, 'SQLWen_files/adizero-running-vest.jpg'),
(8, 'archive-cutline-tee', 1120000, 'SQLWen_files/archive-cutline-tee.jpg'),
(10, 'club-tennis-polo-shirt', 1090000, 'SQLWen_files/club-tennis-polo-shirt.jpg'),
(9, 'badge-graphic-tee', 1250000, 'SQLWen_files/badge-graphic-tee.jpg'),
(11, 'collared-goalie-top(1)', 1180000, 'SQLWen_files/collared-goalie-top(1).jpg'),
(12, 'collared-goalie-top(2)', 1190000, 'SQLWen_files/collared-goalie-top(2).jpg'),
(13, 'collared-goalie-top', 1170000, 'SQLWen_files/collared-goalie-top.jpg'),
(14, 'd4t-x-sleeveless-tee', 920000, 'SQLWen_files/d4t-x-sleeveless-tee.jpg'),
(15, 'dog-soccer-patch-pocket-graphic-tee(1)', 880000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(1).jpg'),
(16, 'dog-soccer-patch-pocket-graphic-tee(2)', 860000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(2).jpg'),
(17, 'dog-soccer-patch-pocket-graphic-tee(3)', 890000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee(3).jpg'),
(18, 'dog-soccer-patch-pocket-graphic-tee', 930000, 'SQLWen_files/dog-soccer-patch-pocket-graphic-tee.jpg'),
(19, 'dog-sock-patch-graphic-tee(1)', 890000, 'SQLWen_files/dog-sock-patch-graphic-tee(1).jpg'),
(20, 'dog-sock-patch-graphic-tee', 910000, 'SQLWen_files/dog-sock-patch-graphic-tee.jpg'),
(21, 'juventus-25-26-away-jersey', 1500000, 'SQLWen_files/juventus-25-26-away-jersey.jpg'),
(22, 'manchester-united-25-26-home-jersey', 1550000, 'SQLWen_files/manchester-united-25-26-home-jersey.jpg'),
(23, 'mercedes---amg-petronas-formula-one-team-driver-jersey-authentic', 1900000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-driver-jersey-authentic.jpg'),
(24, 'mercedes---amg-petronas-formula-one-team-george-russell-tee', 1350000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-george-russell-tee.jpg'),
(25, 'mercedes---amg-petronas-formula-one-team-polo(2)', 1250000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-polo(2).jpg'),
(26, 'mercedes---amg-petronas-formula-one-team-polo', 1200000, 'SQLWen_files/mercedes---amg-petronas-formula-one-team-polo.jpg'),
(27, 'messi-graphic-tee(1)', 950000, 'SQLWen_files/messi-graphic-tee(1).jpg'),
(28, 'messi-graphic-tee(3)', 970000, 'SQLWen_files/messi-graphic-tee(3).jpg'),
(29, 'multi-essentials-2l-rain-jacket', 1480000, 'SQLWen_files/multi-essentials-2l-rain-jacket.jpg'),
(30, 'newcastle-united-fc-25-26-home-jersey', 1400000, 'SQLWen_files/newcastle-united-fc-25-26-home-jersey.jpg'),
(31, 'real-madrid-25-26-away-jersey', 1350000, 'SQLWen_files/real-madrid-25-26-away-jersey.jpg'),
(32, 'real-madrid-25-26-home-authentic-jersey', 1650000, 'SQLWen_files/real-madrid-25-26-home-authentic-jersey.jpg'),
(33, 'real-madrid-25-26-home-jersey', 1500000, 'SQLWen_files/real-madrid-25-26-home-jersey.jpg'),
(34, 'tennis-climacool-freelift-polo-shirt', 990000, 'SQLWen_files/tennis-climacool-freelift-polo-shirt.jpg'),
(35, 'tennis-graphic-tee(1)', 890000, 'SQLWen_files/tennis-graphic-tee(1).jpg'),
(36, 'tennis-graphic-tee', 910000, 'SQLWen_files/tennis-graphic-tee.jpg'),
(37, 'tennis-pro-climacool_-freelift-polo-shirt', 980000, 'SQLWen_files/tennis-pro-climacool_-freelift-polo-shirt.jpg'),
(38, 'trefoilo-essentials-polo-tee(1)', 850000, 'SQLWen_files/trefoilo-essentials-polo-tee(1).jpg'),
(39, 'trefoilo-essentials-polo-tee', 870000, 'SQLWen_files/trefoilo-essentials-polo-tee.jpg'),
(40, 'y-3-short-sleeve-tee-3-stripes', 1120000, 'SQLWen_files/y-3-short-sleeve-tee-3-stripes.jpg');
>>>>>>> cdf4267 (Project)
