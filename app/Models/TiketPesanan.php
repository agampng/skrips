<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketPesanan extends Model
{
    protected $table = 'tiket_pesanan';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['tanggal_tiket_pesanan','nama_perwakilan','email_perwakilan','museum','kode','total_harga','kuota','detail_pesanan','created_at','updated_at'];//fill with non-id
}
