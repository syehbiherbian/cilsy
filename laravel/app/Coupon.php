<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $table = 'coupon';

    public static function findByCode($code)
    {
        return self::where('code', $code)->first();
    }
    public function discount($total)
    {
        if ($this->type == 'fixed') {
            return round($total - $this->value);
        } elseif ($this->type == 'percent') {
            return $total - (($this->percent_off / 100) * $total);
        } else {
            return 0;
        }
    }
}
