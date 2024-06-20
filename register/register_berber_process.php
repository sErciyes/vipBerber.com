<?php
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/Berber.php';

use vipBerber\Berber;
use vipBerber\DB;
use vipBerber\sweetAlert;
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
if (Berber::usernameOrEmailExists($username) || Berber::usernameOrEmailExists($email)) {
    sweetAlert::showSweetAlert('Hata', 'Bu kullanıcı adı veya e-posta adresi zaten kullanılıyor!', 'error');

    die();
}
// Şifreyi hashle
$hasher = new BcryptHasher();
$passwordHash = $hasher->make($password);


// Veritabanına kullanıcıyı ekle
     $berber = new Berber();
     $berber->full_name =$fullname;
     $berber->berber_adres =$address;
     $berber->berber_mail =$email;
     $berber->berber_gender=$gender;
     $berber->berber_username=$username;
     $berber->berber_password=$password;
     $berber->berber_telefon=$phone;
     $berber->save();

if ($berber->exists) {
    sweetAlert::showSweetAlert("Kayıt Başarılı " .$berber->full_name." ","Kayıt başarıyla tamamlandı giriş yapabilirsiniz.","succes","Tamam");
    header("Location: ../login/login.php");
    exit();
} else {
    sweetAlert::showSweetAlert('Hata', 'Kayıt eklenemedi.', 'error');
}

