<?php
session_start();
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/EmailSender.php';

use vipBerber\DB;
use vipBerber\Berber;
use vipBerber\BerberWorkingDay;
use vipBerber\BerberWorkingHour;
use vipBerber\EmailSender;

DB::connect();

$berber_id = $_SESSION['berber_id']; // Berber giriş yaptığında oturumda barber_id saklanmış olmalı
$berber = Berber::find($berber_id);

if (!$berber) {
    die("Berber bulunamadı!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['reset_password'])) {
            // Şifre sıfırlama e-postası gönder
            $email = $berber->berber_mail;

            // Benzersiz şifre sıfırlama token'ı oluştur
            $token = bin2hex(random_bytes(16));
            $berber->reset_token = $token;
            $berber->token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour'));
            $berber->save();

            // E-posta gönderim işlemi
            $emailSender = new EmailSender();
            $subject = 'Parola Sıfırlama';
            $body = "Merhaba, <br><br> Parolanızı sıfırlamak için lütfen aşağıdaki linke tıklayın: <br><br>
                <a href='http://localhost/vipberber/login/password_reset.php?token=$token'>Parolanızı sıfırlayın</a>";
            $result = $emailSender->sendEmail($email, $berber->full_name, $subject, $body);

            if ($result === true) {
                echo 'Parola sıfırlama e-postası gönderildi.';
            } else {
                echo $result;
            }
            } else {
            // Diğer profil güncelleme işlemleri...
            $berber->full_name = $_POST['fullname'];
            $berber->berber_adres = $_POST['address'];
            $berber->berber_mail = $_POST['email'];
            $berber->berber_telefon = $_POST['phone'];
            $berber->save();
        }
    }
    // Çalışma günlerini güncelle
    BerberWorkingDay::where('berber_id', $berber_id)->delete();
    if (isset($_POST['working_days'])) {
        foreach ($_POST['working_days'] as $day) {
            BerberWorkingDay::create(['berber_id' => $berber_id, 'day' => $day]);
        }
    }

    // Çalışma saatlerini güncelle
    BerberWorkingHour::where('berber_id', $berber_id)->delete();
    if (isset($_POST['working_hours'])) {
        foreach ($_POST['working_hours'] as $hour) {
            BerberWorkingHour::create(['berber_id' => $berber_id, 'hour' => $hour]);
        }
    }

    header('Location: berberprofile.php');
    exit();
}
$working_days = $berber->workingDays()->pluck('day')->toArray() ?? [];

// Berberin çalışma saatlerini al
$working_hours = $berber->workingHours()->pluck('hour')->toArray() ?? [];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Berber Profil Sayfası</title>
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

        .profile-container h1 {
            text-align: center;
            color: #333;
        }

        .profile-container form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-container label {
            width: 100%;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        .profile-container input[type="text"],
        .profile-container input[type="email"],
        .profile-container input[type="tel"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .profile-container .working-hours,
        .profile-container .working-days {
            display: flex;
            flex-wrap: wrap;
        }

        .profile-container .working-hours label,
        .profile-container .working-days label {
            flex: 1 0 21%;
            margin: 5px;
            text-align: left;
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
    </style>
</head>
<body>
<div class="profile-container">
    <h1>Berber Profilim</h1>
    <form action="berberprofile.php" method="POST">
        <label for="fullname">Ad Soyad</label>
        <input type="text" name="fullname" id="fullname" value="<?= $berber->full_name ?>" required>

        <label for="address">Adres</label>
        <input type="text" name="address" id="address" value="<?= $berber->berber_adres ?>" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $berber->berber_mail ?>" required>

        <label for="phone">Telefon</label>
        <input type="tel" name="phone" id="phone" value="<?= $berber->berber_telefon ?>" required>
        <form action="berberprofile.php" method="post">
            <button type="submit" name="reset_password">Şifre Sıfırlama E-postası Gönder</button>
        </form>

        <label>Çalışma Günleri</label>
        <div class="working-days">
            <?php
            $daysOfWeek = ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'];
            foreach ($daysOfWeek as $day) {
                $checked = in_array($day, $working_days) ? 'checked' : '';
                echo "<label><input type='checkbox' name='working_days[]' value='$day' $checked> $day</label>";
            }
            ?>
        </div>

        <label>Çalışma Saatleri</label>
        <div class="working-hours">
            <?php
            for ($hour = 6; $hour < 24; $hour += 0.5) {
                $time = sprintf('%02d:%02d', floor($hour), ($hour - floor($hour)) * 60);
                $checked = in_array($time, $working_hours) ? 'checked' : '';
                echo "<label><input type='checkbox' name='working_hours[]' value='$time' $checked> $time</label>";
            }
            ?>
        </div>

        <button type="submit">Güncelle</button>
    </form>
</div>
</body>
</html>
