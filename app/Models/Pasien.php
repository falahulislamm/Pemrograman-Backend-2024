<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public static function getAllPasiens()
    {
        $pasiens = DB::select('select * from pasiens');
        return $pasiens;
    }

    protected $fillable = ['name','phone','address','status','in_date_at','out_date_at'];
}
