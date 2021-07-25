<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Museum extends Model
{
    protected $table = 'museum';//pilih table yang di link dari model
    protected $primarykey = 'id';
    protected $fillable = ['id','schedule_id','created_at','updated_at','kuota','link_google_map'];

    public $incrementing = false;

    public function getMuseumById($museumId)
    {
        $museum = Museum::where('id',$museumId);
        return $museum;
    }

    public function getMuseumScheduleId($museumId)
    {
        //get value of schedule id from collection no get

        $scheduleIdCollection = $this->getMuseumById($museumId)->get();
        $scheduleId = $scheduleIdCollection->implode('schedule_id');
        return $scheduleId;
    }

    public function getQuotaById($museumId)
    {
        $museumCollection = $this->getMuseumById($museumId)->get();
        $quota = $museumCollection->implode('kuota');
        return $quota;
    }
}
