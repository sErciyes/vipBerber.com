<?php
namespace vipBerber;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model {
    protected $table = 'appointments'; // Randevuların bulunduğu tablo adı
    protected $primaryKey = 'appointment_id'; // Birincil anahtar
    public $timestamps = false;

    protected $fillable = [
        'appointment_date',
        'appointment_time',
        'user_id',
        'barber_id',
        'user_verify'
    ];
}
