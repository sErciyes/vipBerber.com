<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../src/DB.php';
require_once '../src/User.php';
require_once '../src/Berber.php';

use vipBerber\Berber;
use vipBerber\User;
use vipBerber\DB;
use Illuminate\Hashing\BcryptHasher;

DB::connect();

$usernameOrEmail = $_POST['username_or_email'];
$password = $_POST['password'];

$user = User::findByUsernameOrEmail($usernameOrEmail);

if (!$user) {
    $berber = Berber::findByUsernameOrEmail($usernameOrEmail);
    $hasher = new BcryptHasher();

    if ($hasher->check($password, $berber->berber_password) || $password == $berber->berber_password) {
        $_SESSION['berber_id'] = $berber->berber_id;
        $_SESSION['perm']="b";
        header('Location: ../Pages/default.php');
        exit();
    } else {
        echo "Şifreli şifre: " . $berber->berber_password . "<br>";
        echo "Girilen şifre: " . $password . "<br>";
        echo "Doğrulama sonucu: false<br>";
        die("Hatalı şifre veya kullanıcı adı/e-posta.");
    }
}

$hasher = new BcryptHasher();
$GirilenHash = $hasher->make($password);
if ($hasher->check($password, $user->user_password) || $password == $user->user_password || $GirilenHash== $user->user_password) {
    $_SESSION['user_id'] = $user->user_id;
    $_SESSION['perm']="u";
    header('Location: ../Pages/default.php');
    exit();
} else {
    echo "Şifreli şifre: " . $user->user_password . "<br>";
    echo "Girilen şifre: " . $password . "<br>";
    echo "Doğrulama sonucu: false<br>";
    echo("Hashlenen sifre : " . $GirilenHash . "<br>");
    print_r($_POST);
    die("Hatalı şifre veya kullanıcı adı/e-posta.");
}
?>
