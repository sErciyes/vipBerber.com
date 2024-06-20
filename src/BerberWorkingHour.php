<?php

namespace vipBerber;

require_once '../vendor/autoload.php';

use Illuminate\Database\Eloquent\Model;

class BerberWorkingHour extends Model
{
    protected $table = 'berber_working_hours';
    protected $fillable = ['berber_id', 'hour'];
    public $timestamps = false;
    public function workingHours() {
        return $this->hasMany(BerberWorkingHour::class, 'berber_id');
    }
    public function GetWorkingHours() {
        // Berberin ID'sini kullanarak çalışma saatlerini getir
        $workingHours = BerberWorkingHour::where('berber_id', $this->berber_id)->pluck('hour')->toArray();

        return $workingHours;
    }
    public static function getWorkingHoursJson($berberId)
    {
        // Berberin ID'sini kullanarak çalışma saatlerini getir
        $workingHours = self::where('berber_id', $berberId)->pluck('hour')->toArray();

        // JSON formatına dönüştür
        $jsonHours = json_encode($workingHours);

        return $jsonHours;
    }

}
