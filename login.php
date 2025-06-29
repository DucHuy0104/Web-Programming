<?php
include("connect.php");

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    echo "Vui lòng nhập email và mật khẩu.";
    exit;
}

$sql = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    die("Lỗi prepare: " . $conn->error);
}
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if ($password === $user['password']) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        echo "success";
    } else {
        echo "Sai mật khẩu.";
    }
} else {
    echo "Email không tồn tại.";
}
?>
