<?php
namespace vipBerber;

require_once '..\vendor\autoload.php';
use Illuminate\Database\Eloquent\Model;

class Berber extends Model {
    protected $table = 'barber';
    protected $primaryKey = 'berber_id';
    public $timestamps = false;

    // Sütunlar
    protected $fillable = [
        'full_name',
        'berber_adres',
        'berber_mail',
        'berber_gender',
        'berber_username',
        'berber_password',
        'berber_telefon'
    ];

    public static function findByUsernameOrEmail($usernameOrEmail) {
        return static::where('berber_username', $usernameOrEmail)
            ->orWhere('berber_mail', $usernameOrEmail)
            ->first();
    }

    public static function usernameOrEmailExists($usernameOrEmail) {
        return static::where('berber_username', $usernameOrEmail)
            ->orWhere('berber_mail', $usernameOrEmail)
            ->exists();
    }
    public function workingDays() {
        return $this->hasMany(BerberWorkingDay::class, 'berber_id');
    }

    public function workingHours() {
        return $this->hasMany(BerberWorkingHour::class, 'berber_id');
    }
}
