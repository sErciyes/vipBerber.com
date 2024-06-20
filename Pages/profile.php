<?php
session_start();
require_once '../vendor/autoload.php';
require_once '../src/DB.php';
require_once '../src/sweetAlert.php';
require_once '../src/EmailSender.php';


use vipBerber\EmailSender;
use vipBerber\User;
use vipBerber\sweetAlert;
use vipBerber\DB;
use vipBerber\Appointment;
use vipBerber\Berber;
use vipBerber\RandevuManager;

if($_SESSION['perm']=="b")
{
    header('Location: berberprofile.php');
    exit();
}

DB::connect();

$user_id = $_SESSION['user_id'];
$user = User::find($user_id);



$randevuManager = new RandevuManager();


$randevular = $randevuManager->getRandevularByUser($user_id);



if (!$user) {
    sweetAlert::showSweetAlert('Hata', 'Kullanıcı bulunamadı!', 'error');
    die();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['profile_picture'])) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            $user->profile_picture = $target_file;
        }
    }

    if (isset($_POST['reset_password'])) {
        // Şifre sıfırlama e-postası gönder
        $email = $user->user_mail;

        // Benzersiz şifre sıfırlama token'ı oluştur
        $token = bin2hex(random_bytes(16));
        $user->reset_token = $token;
        $user->token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $user->save();
        // E-posta gönderim işlemi
        $emailSender = new EmailSender();
        $subject = 'Parola Yenileme';
        $body = "Merhaba, <br><br> Parolanızı sıfırlamak için lütfen aşağıdaki linke tıklayın: <br><br>
                <a href='http://localhost/vipberber/login/password_reset.php?token=$token'>Parolanızı sıfırlayın</a>";
        $result = $emailSender->sendEmail($email, $user->user_full_name, $subject, $body);

        if ($result === true) {
            sweetAlert::showSweetAlert('Parola sıfırlama','Parola sıfırlama e-postası gönderildi.','success');
        } else {
            sweetAlert::showSweetAlert('Parola sıfırlama','Gönderilemedi','error');
        }
    }
    if(isset($_POST['Bilgi_Guncelle'])) {
        $user->user_full_name = $_POST['fullname'];
        $user->user_adres = $_POST['address'];
        $user->user_mail = $_POST['email'];
        $user->user_telefon = $_POST['phone'];
        $user->save();

        sweetAlert::showSweetAlert('Başarılı', 'Bilgiler güncellendi.', 'success');
        header('Location: profile.php');
        exit();
    }
}

// Kullanıcının randevularını çek
$appointments = Appointment::where('user_id', $user_id)->get();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Profil Sayfası</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile-container h1, .profile-container h2 {
            text-align: center;
            color: #333;
        }

        .profile-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-pic-container {
            margin-bottom: 20px;
        }

        .profile-container img {
            max-width: 150px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 20px;
        }

        .profile-container label {
            width: 100%;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        .profile-container input[type="text"],
        .profile-container input[type="email"],
        .profile-container input[type="tel"],
        .profile-container input[type="file"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .profile-container button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .profile-container button:hover {
            background-color: #218838;
        }

        .appointments-container {
            margin-top: 30px;
        }

        .randevu-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .randevu-container h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .appointments-container ul {
            list-style-type: none;
            padding: 0;
        }

        .appointments-container li {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .appointments-container li strong {
            color: #555;
        }
    </style>
    <script src="../js/sweetalert2.min.js"></script>
</head>
<body>
<div class="profile-container">
    <h1>Profilim</h1>
    <form action="profile.php" method="POST" enctype="multipart/form-data">
        <div class="profile-pic-container">
            <img src="<?= $user->profile_picture ?>" alt="Profil Fotoğrafı">
        </div>
        <label for="profile_picture">Profil Fotoğrafı</label>
        <input type="file" name="profile_picture" id="profile_picture">

        <label for="fullname">Ad Soyad</label>
        <input type="text" name="fullname" id="fullname" value="<?= $user->user_full_name ?>" required>

        <label for="address">Adres</label>
        <input type="text" name="address" id="address" value="<?= $user->user_adres ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $user->user_mail ?>" required>

        <label for="phone">Telefon</label>
        <input type="tel" name="phone" id="phone" value="<?= $user->user_telefon ?>" required>
        <button type="submit" name="Bilgi_Guncelle">Güncelle</button>
    </form>
    <br>
    <form action="profile.php" method="post">
        <button type="submit" name="reset_password">Şifre Sıfırlama E-postası Gönder</button>
    </form>
    <div class="appointments-container">
        <?php if ($appointments->isEmpty()): ?>
            <p>Henüz randevunuz bulunmamaktadır.</p>
        <?php else: ?>
            <div class="randevu-container">
                <h2>Randevularım</h2>
                <table>
                    <tr>
                        <th>Tarih</th>
                        <th>Saat</th>
                        <th>Kullanıcı</th>
                        <th>Berber</th>
                    </tr>
                    <?php foreach ($randevular as $randevu): ?>
                        <tr>
                            <td><?php echo $randevu->appointment_date; ?></td>
                            <td><?php echo $randevu->appointment_time; ?></td>
                            <td><?php echo User::find($randevu->user_id)->user_full_name; ?></td>
                            <td><?php echo Berber::find($randevu->barber_id)->full_name; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <a href="default.php">Ana Sayfaya Dön</a>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
