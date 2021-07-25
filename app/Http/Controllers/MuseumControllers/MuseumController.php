<?php

namespace App\Http\Controllers\MuseumControllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\AgendaMuseum;
use App\Models\KoleksiMuseum;


class MuseumController extends Controller
{
    public $imageMuseum;
    public $museumEvent;

    public function __construct()
    {
        $this->imageMuseum = new KoleksiMuseum();//museum collection image model
        $this->museumEvent = new AgendaMuseum();//museum collection
    }
    //
    public function index($namamuseum)
    {

        $selectedCollection = $this->imageMuseum->getMuseumCollectionById($namamuseum);
        $lastSixCollection = $this->imageMuseum->lastSixCollection($selectedCollection)->get();

        $number = 1;
        $museum = Str::slug($namamuseum,' ');
        $event = $this->museumEvent->getMuseumEventById($namamuseum)->get()->take(3);


        return view('museum1.museumX')
        ->with('museum',$museum)
        ->with('number',$number)
        ->with('museumCollection',$lastSixCollection)
        ->with('event',$event);

    }
}
