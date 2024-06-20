<?php

namespace vipBerber;

use Illuminate\Database\Eloquent\Model;

class BerberWorkingDay extends Model
{

    protected $table = 'berber_working_days';
    protected $fillable = ['berber_id', 'day'];
    public $timestamps = false;
    public function workingDays() {
        return $this->hasMany(BerberWorkingDay::class, 'berber_id');
    }
}