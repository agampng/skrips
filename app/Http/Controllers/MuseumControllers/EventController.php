<?php

namespace App\Http\Controllers\MuseumControllers;
use App\Http\Controllers\Controller;
use App\Models\AgendaMuseum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\MuseumEvent;
use App\Models\ImageEvent;

class EventController extends Controller
{
    public $museumEvent;
    public $imageEvent;

    public function __construct()
    {
        $this->museumEvent = new AgendaMuseum();//museum collection image model
    }
    //
    public function index(Request $request,$namamuseum)
    {
        $page = !empty($request->page) ? $request->page : '1';
        //jumlah image yang di show per-halaman
        $limit = 3;
        $event = $this->museumEvent->getMuseumEventById($namamuseum)->get();

        $paginated_collection = $this->museumEvent->paginate($page , $event , $limit);

        $event = $paginated_collection['sliced_collection'];
        //button status
        $prev_button = $paginated_collection['prev_button'];
        $next_button = $paginated_collection['next_button'];
        //ambil nomor page
        $newpage = $paginated_collection['page'];

        return view('museum1.subwebsite.events.event')
        ->with('museum',$namamuseum)
        ->with('event',$event)
        ->with('page',$newpage)
        ->with('prev',$prev_button)
        ->with('next',$next_button);
    }

    public function subindex(Request $request,$namaMuseum,$event)
    {
        $eventId = $request->eventid;
        $event = $this->museumEvent->getSelectedEvent($namaMuseum,$eventId)->get();
        $eventName = $this->museumEvent->getEventName($event);
        $eventDetail = $this->museumEvent->getEventDetail($event);
        $eventStartDate = $this->museumEvent->getEventStartDate($event);
        $eventEndDate = $this->museumEvent->getEventEndDate($event);
        $eventImg = $this->museumEvent->getEventImage($event);

        return view('museum1.subwebsite.events.eventdetail')
        ->with('eventname',$eventName)
        ->with('startDate',$eventStartDate)
        ->with('endDate',$eventEndDate)
        ->with('eventimg',$eventImg)
        ->with('eventdetail',$eventDetail)
        ->with('museum',$namaMuseum);
    }


}
