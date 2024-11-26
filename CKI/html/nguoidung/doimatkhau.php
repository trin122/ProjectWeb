<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "webbansach";

    // Tạo kết nối
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Kiểm tra mật khẩu mới và xác nhận mật khẩu mới có khớp không
    if ($new_password !== $confirm_new_password) {
        echo "Mật khẩu mới và xác nhận mật khẩu không khớp.";
        $conn->close();
        exit();
    }

    // Truy vấn để lấy mật khẩu hiện tại
    $sql = "SELECT matkhau FROM taikhoan WHERE taikhoan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "Tài khoản không tồn tại.";
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->bind_result($db_password);
    $stmt->fetch();

    // Kiểm tra mật khẩu hiện tại
    if ($db_password !== $current_password) {
        echo "Mật khẩu hiện tại không chính xác.";
        $stmt->close();
        $conn->close();
        exit();
    }

    // Cập nhật mật khẩu mới
    $stmt->close();
    $sql = "UPDATE taikhoan SET matkhau = ? WHERE taikhoan = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_password, $username);
    if ($stmt->execute()) {
        echo "Mật khẩu đã được đổi thành công.";
    } else {
        echo "Đổi mật khẩu không thành công.";
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi Mật Khẩu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="/project/LTWEB/CKI/img/logo/logo.jpg" type="image/jpg">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: auto;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #666;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 12px;
            margin-bottom: 0px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            outline: none;
        }

        button {
            padding: 12px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        button.show-password {
            position: absolute;
            right: 0;
            top: 35%;
            background: none;
            border: none;
            color: #007bff;
            font-size: 16px;
            cursor: pointer;
        }

        button.show-password i {
            font-size: 18px;
        }

        .button-group {
            display: flex;
            gap: 100px;
            /* Giảm khoảng cách giữa các nút */
            margin-top: 20px;
        }

        .button-group button {
            flex: 1;
            /* Các nút có cùng kích thước */
        }

        .message {
            color: #721c24;
            /* background-color: #f8d7da;
            border: 1px solid #f5c6cb; */
            padding: 15px;
            margin-top: 15px;
            border-radius: 4px;
        }

        .message.success {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .message.error {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Đổi Mật Khẩu</h2>
        <p id="message" class="message"></p>
        <form action="" method="POST" id="change-password-form">
            <div class="form-group">
                <label for="username">Tài khoản</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="current_password">Mật khẩu hiện tại</label>
                <input type="password" name="current_password" id="current_password" required>
                <button type="button" class="show-password" data-target="#current_password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
            <div class="form-group">
                <label for="new_password">Mật khẩu mới</label>
                <input type="password" name="new_password" id="new_password" required>
                <button type="button" class="show-password" data-target="#new_password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Nhập lại mật khẩu mới</label>
                <input type="password" name="confirm_new_password" id="confirm_new_password" required>
                <button type="button" class="show-password" data-target="#confirm_new_password">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>
            <div class="button-group">
                <button type="button" onclick="window.history.back();">Quay lại</button>
                <button type="submit">Đổi mật khẩu</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.show-password').forEach(button => {
                button.addEventListener('click', function () {
                    const targetInput = document.querySelector(this.dataset.target);
                    const type = targetInput.type === 'password' ? 'text' : 'password';
                    targetInput.type = type;
                    this.querySelector('i').classList.toggle('fa-eye');
                    this.querySelector('i').classList.toggle('fa-eye-slash');
                });
            });

            const form = document.getElementById('change-password-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                const username = document.getElementById('username').value;
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('new_password').value;
                const confirmNewPassword = document.getElementById('confirm_new_password').value;

                const messageElement = document.getElementById('message');

                // Kiểm tra mật khẩu mới và mật khẩu xác nhận có khớp không
                if (newPassword !== confirmNewPassword) {
                    messageElement.textContent = 'Mật khẩu mới và xác nhận mật khẩu không khớp.';
                    messageElement.className = 'message error';
                    return;
                }

                // Gửi yêu cầu AJAX để cập nhật mật khẩu
                const xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        messageElement.textContent = xhr.responseText;
                        messageElement.className = 'message success';
                    } else {
                        messageElement.textContent = 'Đổi mật khẩu không thành công.';
                        messageElement.className = 'message error';
                    }
                };
                xhr.send(`username=${encodeURIComponent(username)}&current_password=${encodeURIComponent(currentPassword)}&new_password=${encodeURIComponent(newPassword)}&confirm_new_password=${encodeURIComponent(confirmNewPassword)}`);
            });
        });
    </script>
</body>

</html>