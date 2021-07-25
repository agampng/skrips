<?php

namespace App\Http\Controllers\AjaxControllers;

use App\Http\Controllers\Controller;
use App\Models\DaftarJadwal;
use App\Models\Museum;
use App\Models\TiketPesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AjaxScheduleController extends Controller
{
    public $scheduleList;
    public $museum;
    public $ticketOrder;
    //
    public function __construct()
    {
        $this->museum = new Museum();//museum model
        $this->scheduleList = new DaftarJadwal();//museum schedule model
        $this->ticketOrder = new TiketPesanan();//museum booking model
        $this->middleware('ajax.only');

    }

    public function getSchedule(Request $request)
    {
        $bookingTicket = $this->ticketOrder;
        $museumId = $request->museum_id;
        $date = $request->visit_date;
        $dateCode = new Carbon($date);
        $todayDateIndex = $dateCode->dayOfWeek;
        $dayLoop = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $dateDay = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
        $firstDayIndex = null;
        $lastDayIndex = null;



        for($i = 0; $i < count($dateDay) ; $i++)
        {
            if($dateDay[$todayDateIndex] == $dayLoop[$i])
            {
                $dayIndex =  $i;
            }
        }//cari hari

        $schedule = $this->scheduleList->where('museum',$museumId)->get();
        $mainQuota = $this->museum->getQuotaById($museumId);

        if($bookingTicket->where('tanggal_tiket_pesanan',$date)->exists())
        {

            $minusQuota = $bookingTicket->where('tanggal_tiket_pesanan',$date)->sum('kuota');
            $Quota = $mainQuota - $minusQuota;
            //cari hari loop
        }else
        {
            $Quota = $mainQuota;
        }

        $scheduleLoop = count($schedule);
        for($i = 0 ; $i < $scheduleLoop; $i++)
            {
                $firstDay = $schedule[$i]->hari_pertama;
                $lastDay = $schedule[$i]->hari_terakhir;

                for($j = 0; $j < count($dayLoop); $j++)
                {

                    $loopingDay = $dayLoop[$j];

                    if($loopingDay == $firstDay)
                    {
                        $firstDayIndex = $j;
                    }//get firstDay index
                    if($loopingDay == $lastDay)
                    {
                        $lastDayIndex = $j;
                    }//get firstDay index
                }//loop cari index hari

                if($dayIndex < $firstDayIndex or $dayIndex > $lastDayIndex )
                {
                    $schedule->forget($i);
                }//menentukan jadwal ditampilkan atau tidak


            }//loop menentukan jadwal ditampilkan atau tidak

        return response()->json(['schedule' =>$schedule, 'quota' =>$Quota]);
    }
}
