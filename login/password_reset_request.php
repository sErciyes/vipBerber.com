<?php
session_start();
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
        $mail->Username = 'vipberber32@gmail.com'; // Gmail kullanıcı adı
        $mail->Password = 'jdwequgqpmdwekmg'; // Gmail şifresi
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('your_email@gmail.com', 'Mailer');
        $mail->addAddress($email, $user->user_full_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = "Merhaba, <br><br> E-posta adresinizi doğrulamak için lütfen aşağıdaki linke tıklayın: <br><br>
        <a href='http://localhost/vipberber/login/send_verification_email.php?token=$token'>E-postanızı doğrulayın</a>";

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
    <title>Parola Sıfırlama</title>
</head>
<body>
<form action="password_reset_request.php" method="post">
    <label for="email">E-posta Adresi:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Parolamı Sıfırla</button>
</form>
</body>
</html>

