<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DaftarJadwal;
use App\Models\Museum;
use App\Models\tiketPesanan;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class NewScheduleController extends Controller
{
    public  $scheduleList;
    public $museum;
    public $ticketOrder;

    public function __construct()
    {
        $this->museum = new Museum();//museum model
        $this->scheduleList = new DaftarJadwal;//museum schedule model
        $this->ticketOrder = new tiketPesanan;//museum booking model
        $this->middleware('auth');
        $this->middleware('ajax.only')->only('getSchedule');
    }

    //
    public function index()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.insertschedule')->with('museum',$museum);
    }

    public function saveschedule(Request $request)
    {

        $request->validate([
            /*

            --belum dipastikan pakai validasi untuk nama hari

            'firstday' =>['required','exists:museum,museum_name'],
            'lastday' =>['required','min:5','max:20'],

            */
            'museum' =>['required','exists:museum,id'],
            'waktu_buka' =>['required'],
            'waktu_tutup' => ['required']
        ]);

        $this->scheduleList->create([
            'hari_pertama' => $request->firstday,
            'hari_terakhir' => $request->lastday,
            'jam_buka' => $request->waktu_buka,
            'jam_tutup' => $request->waktu_tutup,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
            "museum" => $request->museum,
        ]);

        return redirect()->back()->with('message','create successful!');
    }

    public function edit()
    {
        $museum = $this->museum->get();
        return view("admin.adminsub.updateschedule")->with('museum',$museum);
    }

    public function update(Request $request)
    {
        $request->validate([
            'museum' =>['required','exists:museum,id'],
            'waktu_buka' =>['nullable'],
            'waktu_tutup' => ['nullable'],
            'firstday' => ['nullable'],
            'lastday' => ['nullable'],
        ]);

        $scheduleList = $this->scheduleList->find($request->schedule);

        //firstday
            $scheduleList->hari_pertama = $request->firstday;
        //lastday
            $scheduleList->hari_terakhir = $request->lastday;
        //opentime
        if(!empty($request->waktu_buka))
        {
            $scheduleList->jam_buka = $request->waktu_buka;
        }
        //closetime
        if(!empty($request->waktu_tutup))
        {
            $scheduleList->jam_tutup = $request->waktu_tutup;
        }

        $scheduleList->save();

        return redirect()->back()->with('message','update successful!');
    }

    public function show()
    {
        $museum = $this->museum->get();
        return view("admin.adminsub.deleteschedule")->with('museum',$museum);
    }

    public function destroy(Request $request)
    {
        $scheduleList = $this->scheduleList->find($request->schedule);
        $scheduleList->delete();

        return redirect()->back()->with('message','penghapusan berhasil!');
    }

    public function getSchedule(Request $request)
    {
        $museumId = $request->museum_id;
        $schedule = $this->scheduleList->where('museum',$museumId)->get();
        return response()->json($schedule);

    }

    public function testSchedule(Request $request)
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
