<?php
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/User.php';

use vipBerber\User;
use vipBerber\DB;
use vipBerber\sweetAlert;
use vipBerber\Berber;
use Illuminate\Hashing\BcryptHasher;

// Veritabanı bağlantısını oluştur
DB::connect();

// Formdan gelen verileri al
$fullname = $_POST['fullname'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$gender = $_POST['gender'];
$username = $_POST['username'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
// Şifrelerin eşleşip eşleşmediğini kontrol et
if ($password !== $password_confirm) {
   sweetAlert::showSweetAlert('Hata', 'Şifreler eşleşmiyor!', 'error');
    die();
}

// Telefon numarasının regex ile doğrulaması
if (!preg_match('/^(?:(?:(?:\+|00)90)|(?:0))[ -]?(?:\(?\d{3}\)?[ -]?)?(?:\d{3}[ -]?\d{2}[ -]?\d{2})$/', $phone)) {
    sweetAlert::showSweetAlert('Hata', 'Geçersiz telefon numarası!', 'error');
    die();
}

// Kullanıcı adı ve e-posta adresinin benzersiz olup olmadığını kontrol et
if (User::usernameOrEmailExists($username) || User::usernameOrEmailExists($email)) {
    sweetAlert::showSweetAlert('Hata', 'Bu kullanıcı adı veya e-posta adresi zaten kullanılıyor!', 'error');

    die();
}
 // Şifreyi hashle
$hasher = new BcryptHasher();
$passwordHash = $hasher->make($password);

if (isset($_POST['btnBerberKayit'])){
    echo ("berberden gelindi");
}

// Veritabanına kullanıcıyı ekle
if ($_SESSION['gelenKim']=="user"){
    $user = new User();
    $user->user_full_name = $fullname;
    $user->user_adres = $address;
    $user->user_mail = $email;
    $user->user_telefon = $phone;
    $user->user_gender = $gender;
    $user->user_name = $username;
    $user->user_password = $password;
    $user->user_verify = 1; // Başlangıçta  doğrulaması yapılmış olarak ayarlayın
    $user->save();
}
elseif ($_SESSION['gelenKim']=="berber")
{
     echo ("berberdeyiz");
     $berber = new Berber();
     $berber->full_name =$fullname;
     $berber->berber_adres =$address;
     $berber->berber_mail =$email;
     $berber->berber_gender=$gender;
     $berber->berber_username=$username;
     $berber->berber_password=$password;
     $berber->berber_telefon=$phone;
     $berber->save();
}


if ($user->exists) {
    sweetAlert::showSweetAlert("Kayıt Başarılı " .$user->user_full_name." ","Kayıt başarıyla tamamlandı giriş yapabilirsiniz.","succes","Tamam");
    header("Location: ../login/login.php");
    exit();
} else {
    sweetAlert::showSweetAlert('Hata', 'Kayıt eklenemedi.', 'error');
}

