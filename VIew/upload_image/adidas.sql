CREATE DATABASE IF NOT EXISTS products;
USE products;

CREATE TABLE IF NOT EXISTS shoes (
    id INT PRIMARY KEY,
    name VARCHAR(255),
    price DECIMAL(10,2),
    image_url VARCHAR(255)
);

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
