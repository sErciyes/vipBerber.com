<?php



namespace vipBerber;
require_once '../vendor/autoload.php';
require_once 'sweetAlert.php';
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use vipBerber\Berber;

use vipBerber\sweetAlert;


class RandevuManager {
    public function __construct() {
        DB::connect();
    }

    public function randevuAl($secilenTarih, $lsbSaat, $userId, $barberId) {
        $currentDateTime = Carbon::now();
        $selectedDateTime = Carbon::parse("$secilenTarih $lsbSaat");

        if ($selectedDateTime->lessThanOrEqualTo($currentDateTime)) {
            sweetAlert:: showSweetAlert('Hata', 'Geçmişe randevu alınamaz!', 'error');
            echo ("gecmise randevu alınamaz");
            return false;
        }

        $existingAppointment = Appointment::where('appointment_date', $secilenTarih)
            ->where('appointment_time', $lsbSaat)
            ->where('barber_id', $barberId)
            ->first();

        if ($existingAppointment) {
            sweetAlert::showSweetAlert('Hata', 'Bu tarihte ve saatte bu berberin zaten bir randevusu var!', 'error');
            return false;
        }

        if (strlen($secilenTarih) > 0 && strlen($lsbSaat) > 0 && strlen($userId) > 0 && $barberId > 0) {
            try {
                $appointment = new Appointment([
                    'appointment_date' => $secilenTarih,
                    'appointment_time' => $lsbSaat,
                    'user_id' => $userId,
                    'barber_id' => $barberId,
                ]);

                if ($appointment->save()) {
                    $this->sendEmailNotification($userId, $secilenTarih, $lsbSaat,$barberId);
                    sweetAlert::showSweetAlert('Başarılı', 'Randevunuz başarıyla oluşturulmuştur.', 'success');
                    return true;
                } else {
                    sweetAlert:: showSweetAlert('Hata', 'Randevu oluşturulamadı.', 'error');
                    return false;
                }
            } catch (\Exception $e) {
                sweetAlert:: showSweetAlert('Hata', $e->getMessage(), 'error');
                return false;
            }
        } else {
            sweetAlert:: showSweetAlert('Hata', 'Lütfen tüm alanları doldurunuz.', 'error');
            return false;
        }
    }

    private function sendEmailNotification($userId, $secilenTarih, $lsbSaat,$barberId) {
        $user = User::find($userId);
        $berber = Berber::find($barberId);
        if ($user && $user->user_mail) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'vipberber16@gmail.com';
                $mail->Password = 'jdwequgqpmdwekmg';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('vipberber16@gmail.com', 'vipberber');
                $mail->addAddress($user->user_mail, $user->user_full_name);

                $mail->isHTML(true);
                $mail->Subject = 'Randevu Bildirimi';
                $mail->Body    = "Sayın {$user->user_full_name},<br><br>Randevunuz başarıyla oluşturulmuştur.<br><br>Tarih: $secilenTarih<br>Saat: $lsbSaat<br>Berber: {$berber->full_name} <br><br>Teşekkürler.";

                $mail->send();
                sweetAlert:: showSweetAlert('Başarılı', 'Randevu onayı e-postası gönderildi.', 'success');
            } catch (Exception $e) {
                sweetAlert::  showSweetAlert('Hata', "Randevu onayı e-postası gönderilirken bir hata oluştu: {$mail->ErrorInfo}", 'error');
            }
        } else {
            sweetAlert:: showSweetAlert('Hata', 'Kullanıcı bulunamadı veya e-posta adresi yok.', 'error');
        }
    }

    public function getRandevularByBarber($barberId) {
        return Appointment::where('barber_id', $barberId)->get();
    }

    public function getRandevularByUser($userId) {
        return Appointment::where('user_id', $userId)->get();
    }
}

