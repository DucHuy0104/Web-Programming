<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header("Location: upload_image/index.php");
  exit();
}

// Nếu là POST request (khi nhấn nút REGISTER)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  include("connect.php");

  $user = $_POST['user'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $address = $_POST['address'] ?? '';

  if (!$user || !$email || !$password || !$address) {
    echo "Vui lòng điền đầy đủ thông tin.";
    exit;
  }

  // Kiểm tra email tồn tại chưa
  $sql_check = "SELECT * FROM user WHERE email = ?";
  $stmt = $conn->prepare($sql_check);
  if (!$stmt) {
    die("Lỗi prepare: " . $conn->error);
  }
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo "Email đã được sử dụng.";
    exit;
  }

  // Mã hóa mật khẩu
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Thêm vào DB
  $sql_insert = "INSERT INTO user (username, email, password, address) VALUES (?, ?, ?, ?)";
  $stmt = $conn->prepare($sql_insert);
  if (!$stmt) {
    die("Lỗi prepare (insert): " . $conn->error);
  }
  $stmt->bind_param("ssss", $user, $email, $hashed_password, $address);

  if ($stmt->execute()) {
    echo "success";
  } else {
    echo "Đăng ký thất bại: " . $conn->error;
  }
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Register</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }
    body {
      margin: 0;
      height: 100vh;
      background-color: #2b2b2b;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .register-container {
      background-color: #555;
      padding: 30px 20px;
      border-radius: 10px;
      text-align: center;
      width: 300px;
      color: white;
    }
    .register-container img {
      width: 60px;
      margin-bottom: 20px;
    }
    .input-box {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
    }
    .register-btn {
      width: 100%;
      padding: 12px;
      background-color: #91b8cd;
      border: none;
      border-radius: 5px;
      color: black;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }
    .register-btn:hover {
      background-color: #7ca7bd;
    }
    .error {
      color: #ffb3b3;
      font-size: 12px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="register-container">
    <img src="https://upload.wikimedia.org/wikipedia/commons/2/20/Adidas_Logo.svg" alt="Logo" />
    
    <div id="errorMsg" class="error"></div>
    
    <input type="text" id="user" class="input-box" placeholder="USER" />
    <input type="text" id="email" class="input-box" placeholder="EMAIL ADDRESS" />
    <input type="password" id="password" class="input-box" placeholder="PASSWORD" />
    <input type="text" id="address" class="input-box" placeholder="ADDRESS" />

    <button class="register-btn" onclick="register()">REGISTER</button>
  </div>

  <script>
  function register() {
    const user = document.getElementById("user").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const address = document.getElementById("address").value.trim();
    const errorDiv = document.getElementById("errorMsg");

    const formData = new FormData();
    formData.append("user", user);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("address", address);

    fetch("register.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.text())
    .then(data => {
      if (data === "success") {
        errorDiv.style.color = "lightgreen";
        errorDiv.textContent = "Đăng ký thành công! Đang chuyển hướng...";
        setTimeout(() => {
          window.location.href = "login.php"; // ← chỉnh đường dẫn nếu cần
        }, 1500);
      } else {
        errorDiv.style.color = "#ffb3b3";
        errorDiv.textContent = data;
      }
    });
  }
  </script>
</body>
</html>
