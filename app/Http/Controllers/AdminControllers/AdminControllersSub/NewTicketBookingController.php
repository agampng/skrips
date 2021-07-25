<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use App\Http\Controllers\Controller;
use App\Models\Museum;
use App\Models\TiketPesanan;
use Illuminate\Http\Request;

class NewTicketBookingController extends Controller
{
    public $museum;
    //
    public function __construct()
    {
        $this->museum = new Museum;
    }

    public function index()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.insertticketbooking')->with('museum',$museum);
    }

    public function edit()
    {
        $museum = $this->museum->get();
        return view('admin.adminsub.updateticketbooking')->with('museum',$museum);
    }

    public function showDelete()
    {
        $myBooking = TiketPesanan::where('museum', auth()->user()->museum_id)->get();

        return view('admin.adminsub.deletepesanan', compact('myBooking'));
    }

    public function destroy(Request $request)
    {
        $item = TiketPesanan::findorFail($request->select_booking);
        $item->delete();

        return redirect()->back()->with('message','Penghapusan berhasil!');
    }
}
