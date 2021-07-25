<?php

namespace App\Http\Controllers\AdminControllers\AdminControllersSub;

use App\Http\Controllers\Controller;
use App\Models\Museum;
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
}
