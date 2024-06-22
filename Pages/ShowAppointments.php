<?php
require_once '../vendor/autoload.php'; // Composer autoload
require_once '../src/DB.php'; // Veritabanı bağlantısı
require_once '../src/User.php'; // User modeli
require_once '../src/Appointment.php'; // Appointment modeli
require_once '../src/RandevuManager.php'; // RandevuManager sınıfı

use vipBerber\RandevuManager;
use vipBerber\DB;
use vipBerber\User;

// Veritabanı bağlantısını oluştur
DB::connect();

session_start();

$userId = $_SESSION['user_id'];
$user = User::find($userId);

$randevuManager = new RandevuManager();

if ($user->user_role == 'barber') {
    $randevular = $randevuManager->getRandevularByBarber($userId);
} else {
    $randevular = $randevuManager->getRandevularByUser($userId);
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Randevular</title>
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
        }

        .randevu-container {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 800px;
            text-align: center;
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
    </style>
</head>
<body>
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
                <td><?php echo User::find($randevu->barber_id)->user_full_name; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="default.php">Ana Sayfaya Dön</a>
</div>
</body>
</html>
