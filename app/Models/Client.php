<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    public function accounts()
    {
        return $this->hasMany(Account::class, 'client_id', 'id');
    }
    static public function personID () {
        $pid = '';
        $cn = rand(1, 6);
        $yn = sprintf('%02d', mt_rand(0, 99));
        $mn = sprintf('%02d', mt_rand(1,12));
        $dn = sprintf('%02d', mt_rand(1, 31));
        $cn2 = sprintf('%04d', mt_rand(0, 9999));
        $pid = "$cn$yn$mn$dn$cn2";
        $pid = (int)$pid;
        return $pid;
    }
}
