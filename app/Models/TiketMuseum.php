<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketMuseum extends Model
{
    protected $table = 'tiket_museum';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['harga','target','jadwal_id','created_at','updated_at'];//fill with non-id
}
