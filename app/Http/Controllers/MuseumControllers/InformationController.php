<?php

namespace App\Http\Controllers\MuseumControllers;
use App\Http\Controllers\Controller;
use App\Models\DaftarJadwal;
use App\Models\Museum;
use App\Models\TiketMuseum;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class InformationController extends Controller
{

    public $museum;
    public $scheduleList;
    public $museumTicket;

    public function __construct()
    {
        $this->museum = new Museum;//museum model
        $this->scheduleList = new DaftarJadwal;//schedule list model
        $this->museumTicket = new TiketMuseum;//museum ticket model
    }

    //
    public function index($namaMuseum)
    {
        $nama = $namaMuseum;
        $link = $this->museum->getMuseumById($nama)->get()->implode('link_google_map');
        $jadwal =$this->scheduleList->getScheduleListByMuseumId($nama)->get();
        $ticket =$this->museumTicket->get();
        return view('museum1.subwebsite.informations.information')
        ->with('museum',$nama)
        ->with('ticket',$ticket)
        ->with('jadwal',$jadwal)
        ->with('link',$link);
    }
}
