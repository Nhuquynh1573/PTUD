<?php
    include_once("..//controller/cUser.php");
    if(isset($_REQUEST["btnDangNhap"])){
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $p = new ControllerUser();
        $kq = $p->login($email, md5($password));
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('../img/pexels-photo-61135.jpeg');
            background-size: cover; 
            background-position: center; 
            height: 100vh; 
        }
        .login-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            position: relative; /* Add this line */
        }
        .login-title {
            font-weight: bold;
            margin-bottom: 20px;
            color: #0062E6;
        }
        .btn-primary {
            background-color: #0062E6;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-muted {
            color: #6c757d;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            color: #0062E6;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4 login-container">
            <button class="close-btn" onclick="window.history.back();">&times;</button>
            <h2 class="text-center login-title">Đăng nhập</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="btnDangNhap">Đăng nhập</button>
            </form>
            <p class="text-center mt-3">
                <span class="text-muted">Chưa có tài khoản?</span> <a href="dangki.php" class="text-primary">Đăng ký ngay</a>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


