<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTiketPesanan extends Model
{
    protected $table = 'detail_tiket_pesanan';//pilih table yang di link dari model
    protected $fillable = ['pesanan_id','detail','jumlah','created_at','updated_at'];


}
