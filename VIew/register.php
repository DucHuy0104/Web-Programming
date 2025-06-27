<?php
include("connect.php");

$user = $_POST['user'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';
$address = $_POST['address'] ?? '';

if (!$user || !$email || !$password || !$address) {
    echo "Vui lòng điền đầy đủ thông tin.";
    exit;
}

$sql_check = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sql_check);
if (!$stmt) {
    die("Lỗi prepare: " . $conn->error); // In lỗi chi tiết
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "Email đã được sử dụng.";
    exit;
}

$sql_insert = "INSERT INTO user (username, email, password, address) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
if (!$stmt) {
    die("Lỗi prepare (insert): " . $conn->error);
}
$stmt->bind_param("ssss", $user, $email, $password, $address);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Đăng ký thất bại: " . $conn->error;
}
?>
