<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgendaMuseum;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


use App\Models\Museum;
use Illuminate\Support\Facades\Log;

class NewEventController extends Controller
{
    public $museum;
    public $museumEvent;
    public $imageEvent;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax.only')->only('getEvent');
        $this->museum = new Museum;//museum model
        $this->museumEvent = new AgendaMuseum;//museum event model

    }

    public function index()
    {
        $museum = $this->museum->get();
        //dd($museum);
        return view('admin.adminsub.insertevent')
        ->with('museum',$museum);
    }

    public function saveevent(Request $request)
    {
        $request->validate([
            'museum' => ['required','exists:museum,id'],
            'event_title' => ['required','min:5','max:50'],
            'event_start_date'=> ['required','Date'],
            'event_end_date'=> ['required','Date'],
            'event_description' => ['required','min:10'],
            'event_text' => ['required','min:10'],
            'event_image' => ['required','image','mimes:jpeg,png,jpg'],
        ]);

        if($request->event_image){
            $image_img = $request->event_image;
            $imageName = Str::slug($request->museum,'-').'-'.time().'.'.$image_img->extension();
            $image_img->move(public_path('events'),$imageName);
        }

        //simpan event baru
        $event_id = $this->museumEvent->insertGetId([
            'nama_agenda' => $request->event_title,
            'museum_id' => $request->museum,
            'nama_gambar' => $imageName,
            'deskripsi_agenda' => $request->event_description,
            'isi_agenda' => $request->event_text,
            'tanggal_mulai_agenda' => $request->event_start_date,
            'tanggal_berakhir_agenda' => $request->event_end_date,
            'created_at' =>  date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('message','Pembuatan Berhasil!');
    }

    public function edit()
    {
        $museum = $this->museum->get();
        $event = $this->museumEvent->get();
        //dd($museum);
        return view('admin.adminsub.updateevent')
        ->with('event',$event)
        ->with('museum',$museum);
    }

    public function update(Request $request)
    {

        $request->validate([
            'museum' => ['required','exists:museum,id'],
            'event' => ['required','exists:agenda_museum,id'],
            'event_start_date'=> ['nullable','Date'],
            'event_end_date'=> ['nullable','Date'],
            'event_description' => ['nullable','min:10'],
            'event_text' => ['nullable','min:10'],
            'event_image' => ['nullable','image','mimes:jpeg,png,jpg'],
        ]);


        $museumEvent = $this->museumEvent->find($request->event);

        //event_description
        if(!empty($request->event_description))
        {
            $museumEvent->deskripsi_agenda = $request->event_description;
        }
        //event_text
        if(!empty($request->event_text))
        {
            $museumEvent->isi_agenda = $request->event_text;
        }
        //event_start_date
        if(!empty($request->event_start_date))
        {
            $museumEvent->tanggal_mulai_agenda = $request->event_start_date;
        }
        //event_end_date
        if(!empty($request->event_end_date))
        {
            $museumEvent->tanggal_berakhir_agenda = $request->event_end_date;
        }
        //event image
        if(isset($request->event_image))
        {
            if($request->event_image){
                $image_img = $request->event_image;
                $imageName = $request->museum.'-'.time().'.'.$image_img->extension();
                $image_img->move(public_path('events'),$imageName);
            }

            $museumEvent->nama_gambar = $imageName;
        }

        $museumEvent->save();

        return redirect()->back()->with('message','Pembaruan Berhasil!');
    }

    public function getEvent(Request $request)
    {
        $museumId = $request->museum_id;
        $event = $this->museumEvent->where('museum_id',$museumId)->get();
        return response()->json($event);

    }
}
