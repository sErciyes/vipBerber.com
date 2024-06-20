<?php
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/User.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use vipBerber\User;
use vipBerber\DB;

DB::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Kullanıcıyı veritabanında kontrol edin
    $user = User::where('user_mail', $email)->first();
    if (!$user) {
        die("Bu e-posta adresi ile kayıtlı kullanıcı bulunamadı.");
    }

    // Benzersiz doğrulama token'ı oluştur
    $token = bin2hex(random_bytes(16));
    $user->verification_token = $token;
    $user->save();

    // E-posta gönderim işlemi
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP sunucusu
        $mail->SMTPAuth = true;
        $mail->Username = 'vipberber16@gmail.com'; // Gmail kullanıcı adı
        $mail->Password = 'jdwequgqpmdwekmg'; // Gmail şifresi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('vipberber16@gmail.com', 'vipberber');
        $mail->addAddress($user->user_mail, $user->user_full_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Merhaba $user->user_full_name, <br><br> E-posta adresinizi doğrulamak için lütfen aşağıdaki linke tıklayın: <br><br>
        <a href='http://localhost/vipberber/login/verify.php?token=$token'>E-postanızı doğrulayın</a>";

        $mail->send();
        echo 'Doğrulama e-postası gönderildi.';
    } catch (Exception $e) {
        echo "E-posta gönderilemedi. Mailer Hatası: {$mail->ErrorInfo}";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Email Doğrulama</title>
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

        .container input[type="email"] {
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
    <h1>Email Doğrulama</h1>
    <form action="send_verification_email.php" method="POST">
        <input type="email" name="email" placeholder="E-posta adresinizi girin" required>
        <button type="submit">Doğrulama Emaili Gönder</button>
    </form>
</div>
</body>
</html>
