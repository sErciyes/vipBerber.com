<?php
namespace vipBerber;

require_once '../vendor/autoload.php';
require_once '../src/DB.php'; // DB bağlantı dosyanızın yolunu düzenleyin
require_once '../src/Berber.php'; // Berber sınıfının yolunu düzenleyin
use vipBerber\Berber;

// Veritabanı bağlantısını başlatma
DB::connect();

// AJAX isteğinden gelen berber_id parametresini alın
$berberId = $_GET['berber_id'];

// Berber ID'si gönderilmişse çalışma saatlerini JSON olarak alın
if ($berberId) {
    $jsonHours = BerberWorkingHour::getWorkingHoursJson($berberId);
    echo $jsonHours;
} else {
    // Hata durumu: Berber ID'si gönderilmemişse boş JSON döndür
    echo json_encode([]);
}
?>
