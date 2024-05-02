<?php
class DB {
    private static $conn;

    public static function connect() {
        try {
            if (self::$conn === null) {
                // MySQL veritabanı bağlantısı
                $servername = "localhost"; // MySQL sunucu adresi
                $username = "root"; // MySQL kullanıcı adı
                $password = ""; // MySQL şifresi 
                $database = "dbberber"; // Kullanmak istediğiniz veritabanının adı
                
                // PDO nesnesini oluşturma
                self::$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                
                // Hata modunu ayarlama
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$conn;
        } catch(PDOException $e) {
            // Bağlantı hatasını yakala ve işle
            die("Bağlantı hatası: " . $e->getMessage());
        }
    }
}

