<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\TiketMuseum;
use Illuminate\Contracts\Validation\Rule;

class NewTicketController extends Controller
{
    public $museum;
    public $ticket;
    //
    public function __construct()
    {
        //inject repository here
        $this->museum = new Museum;//museum class
        $this->ticket = new TiketMuseum;//museum class
        $this->middleware('auth');
        $this->middleware('ajax.only')->only('getTicket');
    }

    public function index()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.insertticket')
        ->with('museum',$museum);
    }

    public function saveticket(Request $request)
    {
        //dd($request);
        $request->validate([
            'museum' =>['required','exists:museum,id'],
            'schedule' => ['required','exists:daftar_jadwal,id'],
            'target' => ['required'],
            'price' => ['required','numeric'],
        ]);

        $this->ticket->create([
            'harga' => $request->price,
            'target' => $request->target,
            'jadwal_id' => $request->schedule,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);


        return redirect()->back()->with('message','pembuatan berhasil!');
    }

    public function edit()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.updateticket')
        ->with('museum',$museum);
    }

    public function update(Request $request)
    {
        $request->validate([
            'museum' =>['required','exists:museum,id'],
            'schedule' => ['required','exists:daftar_jadwal,id'],
            'ticket' => ['required','exists:tiket_museum,id'],
            'target' => ['required','unique:tiket_museum,target,'.$request->ticket.',id,jadwal_id,'.$request->schedule],
            'price' => ['required','numeric'],
        ]);

        $ticket = $this->ticket->find($request->ticket);
        //"target"
        if(!empty($request->ticket))
        {
            $ticket->target = $request->target;
        }
        //"price"
        if(!empty($request->price))
        {
          $ticket->harga = $request->price;
        }

        $ticket->save();

        return redirect()->back()->with('message','pebaruan berhasil!');
    }

    public function show()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.deleteticket')
        ->with('museum',$museum);
    }

    public function destroy(Request $request)
    {
        $ticket = $this->ticket->find($request->ticket);
        $ticket->delete();

        return redirect()->back()->with('message','penghapusan berhasil!');
    }

    public function getTicket(Request $request)
    {
        $ticket = $this->ticket->where('jadwal_id',$request->schedule_id)->get();
        return response()->json($ticket);
    }
}
