<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Museum;

class WelcomeController extends Controller
{
    public $museum;

    //
    public function path()
    {
        return view('path');
    }

    public function __construct()
    {
        $this->museum = new Museum;
    }

    public function index()
    {
        $museums = $this->museum->get();

        return view('museum1.welcome')->with('museum',$museums);
    }
}
