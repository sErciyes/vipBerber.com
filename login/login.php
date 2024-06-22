<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../src/DB.php';
require_once '../src/User.php';
require 'google.php';

use vipBerber\User;
use vipBerber\DB;
use Illuminate\Hashing\BcryptHasher;

// Veritabanı bağlantısını oluştur
try {
    DB::connect();
} catch (Exception $e) {
    echo $e->getMessage();
}

$google_client = new Google_Client();
$google_client->setClientId("515407427816-cqsh228eii9tc1gaut050effi45u7flu.apps.googleusercontent.com");
$google_client->setClientSecret("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");
$google_client->setRedirectUri("http://localhost/vipberber/login/google_callback.php");
$google_client->addScope("email");
$google_client->addScope("profile");

// Google OAuth URL'sini alın
$google_login_url = $google_client->createAuthUrl();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.2);
            width: 350px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }

        .login-container h2 {
            margin-bottom: 30px;
            animation: slideIn 0.5s ease-in-out;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #007bff;
            box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
        }

        .login-container input[type="submit"] {
            width: calc(100% - 40px);
            padding: 10px;
            margin-top: 10px;
            background-color: #007bff;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s ease-in-out, transform 0.2s;
        }

        .login-container input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .login-container input[type="submit"]:active {
            transform: scale(1);
        }

        .login-container p {
            margin-top: 15px;
        }

        .login-container a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease-in-out;
        }

        .login-container a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>vipberber.com</h1>
    <h2>Giris</h2>
    <form action="login_process.php" method="post">
        <input type="text" name="username_or_email" placeholder="Username or Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Giriş Yap">
    </form>

    <a href="<?= $google_login_url ?>"> <input type="submit" id="btnGoogle" name="btnGoogle" value="Google ile devam et"></a>
    <br>
    <p>Henüz hesabın yok mu? <a href="../register/register.php">Kayıt Ol</a></p>
    <p>Berber olarak <a name="berberkayit" id="berberkayitid" href="../register/registerberber.php">Kayıt Ol</a></p>
</div>
</body>
</html>
