<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    
    static public function accountNumberGen () {
        $iban = '';
        $cn = sprintf('%02d', mt_rand(0, 99));
        $bn = '3500 0';
        $un1 = sprintf('%03d', mt_rand(0, 999));
        $un2 = sprintf('%04d', mt_rand(0, 9999));
        $un3 = sprintf('%04d', mt_rand(0, 9999));
        $iban = "LT$cn $bn$un1 $un2 $un3";
        return $iban;
    }
}