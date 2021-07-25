<?php

namespace App\Http\Controllers;

use App\Models\AgendaMuseum;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public $museumEvent;

    public function __construct()
    {
        $this->museumEvent = new AgendaMuseum();
    }
    //
    public function index($namamuseum,Request $request)
    {
        $event = $this->museumEvent->getMuseumEventById($namamuseum);
        $search = $event->where('nama_agenda','like','%'.$request->input.'%')->get();


        $page = !empty($request->page) ? $request->page : '1';
        //jumlah image yang di show per-halaman
        $limit = 3;
        $event = $event->where('nama_agenda','like','%'.$request->input.'%')->get();

        $paginated_collection = $this->museumEvent->paginate($page , $event , $limit);

        $search = $paginated_collection['sliced_collection'];
        //button status
        $prev_button = $paginated_collection['prev_button'];
        $next_button = $paginated_collection['next_button'];
        //ambil nomor page
        $newpage = $paginated_collection['page'];

        return view('museum1.subwebsite.search')
        ->with('museum',$namamuseum)
        ->with('event',$search)
        ->with('page',$newpage)
        ->with('prev',$prev_button)
        ->with('next',$next_button);
    }
}
