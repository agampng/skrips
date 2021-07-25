<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AgendaMuseum;
use App\Models\DaftarJadwal;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use App\Models\Museum;
use App\Models\KoleksiMuseum;
use GuzzleHttp\Psr7\Message;

class NewMuseumController extends Controller
{
    public  $museum;
    public  $collection;
    public  $event;
    public  $scheduleList;

    public function __construct()
    {
        $this->middleware('auth');
        $this->museum = new Museum;//museum model
        $this->collection = new KoleksiMuseum();//museum model
        $this->event = new AgendaMuseum();//museum model
        $this->scheduleList = new DaftarJadwal();//museum collection image model
    }

    public function index()
    {
        $museum = $this->museum->all();
        $schedule = $this->scheduleList->get();

        return view('admin.adminsub.insertmuseumpage')
        ->with('jadwal',$schedule);
    }

    public function savemuseum(Request $request)
    {

        //validation request
        $request->validate([
            'museum' => ['required','min:5','max:50'],
            'image' => ['image','mimes:jpeg,png,jpg'],
            'kuota' => ['required'],
            'linkGoogleMap' => ['required']
        ]);

        if($request->image){
            $image_img = $request->image;
            $imageCode = Str::slug($request->museum,'-').'-'.time().'.'.$image_img->extension();
            $image_img->move(public_path('museum'),$imageCode);
        }



        $this->museum->create([
            'id' => $request->museum,
            'gambar' => $imageCode,
            'kuota' => $request->kuota,
            'link_google_map' => $request->linkGoogleMap,
            "created_at" =>  date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s'),
        ]);

        return redirect()->back()->with('message','Pemesanan Berhasil!');
    }

    public function edit()
    {
        $museum = $this->museum->all();


        return view('admin.adminsub.updatemuseum')
        ->with('museum',$museum);
    }

    public function update(Request $request)
    {
        $request->validate([
            'museum' => ['exists:museum,id'],
            'image' => ['image','mimes:jpeg,png,jpg|nullable'],
            'rename' => ['unique:museum,id|min:5|max:50|nullable'],
            'kuota' => ['required'],
            'linkGoogleMap' => ['required']
        ]);//validasi request

        if($request->image){
            $image_img = $request->image;
            $imageCode = Str::slug($request->museum,'-').'-'.time().'.'.$image_img->extension();
            $image_img->move(public_path('museum'),$imageCode);
        }


        $museum = $this->museum;//db collection
        $collection = $this->collection;//db collection
        $event = $this->event;//db collection

        $target1 = $museum->find($request->museum);
        if(!empty($request->rename))
        {
            $target1->id = $request->rename;
        }
        if(!empty($request->image))
        {
            $target1->gambar = $imageCode;
        }
        if(!empty($request->kuota))
        {
            $target1->gambar = $request->kuota;
        }
        if(!empty($request->linkGoogleMap))
        {
            $target1->gambar = $request->linkGoogleMap;
        }
        //save updated data
        $target1->save();

        return redirect()->back()->with('message','Update Successful!');
    }
}
