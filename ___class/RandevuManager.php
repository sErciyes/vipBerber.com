<?php
class RandevuManager {
    private $db;

    public function __construct() {
        
    }

    public function randevuAl($secilenTarih, $lsbSaat, $txtAd, $txtTelefon, $txtAdres, $userId) {
        // Veritabanına bağlan
        $conn = DB::connect();
    
        // Veritabanı bağlantısını kontrol et
        if ($conn) {
            // Gerekli alanların doldurulup doldurulmadığını kontrol et
            if (strlen($secilenTarih) > 0 && strlen($lsbSaat) > 0 && strlen($txtAd) > 0 && strlen($txtTelefon) > 0 && strlen($txtAdres) > 0) {
                try {
                    // Veritabanına ekleme işlemi için SQL sorgusunu hazırla
                    $sql = "INSERT INTO TBLRANDEVU (AD, TELEFON, ADRES, SAAT, RANDEVUTARIHI, USERID) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $conn->prepare($sql);
    
                    // Değişkenleri bağla
                    $stmt->bindParam(1, $txtAd);
                    $stmt->bindParam(2, $txtTelefon);
                    $stmt->bindParam(3, $txtAdres);
                    $stmt->bindParam(4, $lsbSaat);
                    $stmt->bindParam(5, $secilenTarih);
                    $stmt->bindParam(6, $userId);
    
                    // Sorguyu çalıştır
                    if ($stmt->execute()) {
                        // İşlem başarılıysa true döndür
                        return true;
                    } else {
                        // İşlem başarısız ise false döndür
                        return false;
                    }
                } catch(PDOException $e) {
                    // Hata oluştuğunda false döndür
                    return false;
                }
            } else {
                // Gerekli alanlar doldurulmadıysa false döndür
                return false;
            }
        } else {
            // Veritabanı bağlantısı başarısız ise false döndür
            return false;
        }
    }
}
?>