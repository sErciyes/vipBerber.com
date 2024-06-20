<?php
namespace vipBerber;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'user_full_name',
        'user_adres',
        'user_mail',
        'user_telefon',
        'user_gender',
        'user_name',
        'user_password',
        'phone_verified',
        'verification_token', // diğer alanlar
    ];

    public static function findByUsernameOrEmail($usernameOrEmail) {
        return static::where('user_name', $usernameOrEmail)
            ->orWhere('user_mail', $usernameOrEmail)
            ->first();
    }

    public static function usernameOrEmailExists($usernameOrEmail) {
        return static::where('user_name', $usernameOrEmail)
            ->orWhere('user_mail', $usernameOrEmail)
            ->exists();
    }


}
