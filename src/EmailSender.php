<?php

namespace vipBerber;

require_once '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailSender {
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer(true);
        $this->setup();
    }

    private function setup() {
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'vipberber16@gmail.com';
        $this->mail->Password = 'jdwequgqpmdwekmg'; // Gmail şifresi
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
        $this->mail->setFrom('vipberber16@gmail.com', 'vipBerber');
    }

    public function sendEmail($recipientEmail, $recipientName, $subject, $body) {
        try {
            $this->mail->addAddress($recipientEmail, $recipientName);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return true;
        } catch (Exception $e) {
            return "E-posta gönderilemedi. Mailer Hatası: {$this->mail->ErrorInfo}";
        }
    }
}

?>
