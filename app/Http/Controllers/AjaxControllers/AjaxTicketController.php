<?php


namespace App\Http\Controllers\AjaxControllers;

use App\Http\Controllers\Controller;
use App\Models\TiketMuseum;
use Illuminate\Http\Request;

class AjaxTicketController extends Controller
{
    public $ticket;
    //
    public function __construct()
    {
        $this->ticket = new TiketMuseum();//museum class
        $this->middleware('ajax.only');
    }

    public function getTicket(Request $request)
    {
        $ticket = $this->ticket->where('jadwal_id',$request->schedule_id)->get();
        return response()->json($ticket);
    }
}
