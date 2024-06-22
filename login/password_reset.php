<?php
session_start();
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/User.php';

use vipBerber\DB;
use vipBerber\User;
use vipBerber\sweetAlert;

DB::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];

    // Kullanıcıyı veritabanında kontrol edin
    $user = User::where('reset_token', $token)
        ->where('token_expiration', '>=', date('Y-m-d H:i:s'))
        ->first();

    if (!$user) {
        die("Geçersiz veya süresi dolmuş token.");
    }

    // Yeni parolayı kaydet
    $user->user_password = $new_password;
    $user->reset_token = null; // Token'ı sıfırla
    $user->token_expiration = null;
    $user->save();

    sweetAlert::showSweetAlert('Parolanız başarıyla sıfırlandı','Yeni parolanızla giriş yapabilirsiniz.','success');
    echo "Parolanız başarıyla sıfırlandı. Yeni parolanızla giriş yapabilirsiniz.";
    header('Location: login.php');
    exit();
}

if (!isset($_GET['token'])) {
    die("Token sağlanmadı.");
}

$token = $_GET['token'];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Parola Sıfırlama</title>

</head>
<body>
<form action="password_reset.php" method="post">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <label for="new_password">Yeni Parola:</label>
    <input type="password" id="new_password" name="new_password" required>
    <button type="submit">Parolamı Sıfırla</button>
</form>
</body>
</html>
