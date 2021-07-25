<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarJadwal extends Model
{
    protected $table = 'daftar_jadwal';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['museum','hari_pertama','hari_terakhir','jam_buka','jam_tutup','created_at','updated_at'];

    public function getScheduleListByMuseumId($museumid)
    {
        //pilih schedule by id
        $schedule = DaftarJadwal::where('museum',$museumid);
        return $schedule;
    }
}
