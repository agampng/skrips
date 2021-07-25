<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MuseumInfo extends Model
{
    protected $table = 'museum_info';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['info_name','info_data','museum_id'];
}
