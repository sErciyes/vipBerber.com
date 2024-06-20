<?php
session_start();
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/User.php';

use vipBerber\User;
use vipBerber\DB;

DB::connect();

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Kullanıcıyı token ile bul
    $user = User::where('verification_token', $token)->first();
    if (!$user) {
        die("Geçersiz token.");
    }

    // Token geçerliliğini kontrol edin (örneğin, 24 saat içinde kullanılmalı)
    $tokenCreated = strtotime($user->updated_at); // Token oluşturulma zamanı
    if (time() - $tokenCreated > 86400) { // 24 saat
        die("Token süresi dolmuş.");
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        $newPassword = $_POST['password'];
        $user->user_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $user->verification_token = null; // Token'ı sıfırla
        $user->save();

        echo "Şifreniz başarıyla güncellendi.";
        header('Location: login.php'); // Login sayfasına yönlendir
        exit();
    }
} else {
    die("Token bulunamadı.");
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Şifre Güncelleme</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 40%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }

        .container h1 {
            color: #333;
        }

        .container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .container button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Şifre Güncelleme</h1>
    <form action="verify.php?token=<?= htmlspecialchars($_GET['token']) ?>" method="POST">
        <input type="password" name="password" placeholder="Yeni Şifre" required>
        <button type="submit">Güncelle</button>
    </form>
</div>
</body>
</html>
