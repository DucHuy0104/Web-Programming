<?php
include 'connect.php';

// Giả sử lấy ID người dùng từ GET hoặc session
$user_id = $_GET['id'] ?? 1;

$sql = "SELECT * FROM `user` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Không tìm thấy người dùng.";
    exit;
}

$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin người dùng</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .profile {
            background-color: white;
            max-width: 400px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .profile h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 10px;
        }
        .info label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="profile">
        <h2>Thông tin người dùng</h2>
        <div class="info"><label>ID:</label> <?= htmlspecialchars($user['id']) ?></div>
        <div class="info"><label>Tên đăng nhập:</label> <?= htmlspecialchars($user['username']) ?></div>
        <div class="info"><label>Email:</label> <?= htmlspecialchars($user['email']) ?></div>
        <div class="info"><label>Địa chỉ:</label> <?= htmlspecialchars($user['address']) ?></div>
    </div>
</body>
</html>
