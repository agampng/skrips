<?php

namespace App\Http\Controllers\MuseumControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\KoleksiMuseum;

class CollectionController extends Controller
{
    public $imageMuseum;

    public function __construct()
    {
        $this->imageMuseum = new KoleksiMuseum();//museum collection image model
    }
    //
    public function index(Request $request,$namamuseum)
    {
        $page = !empty($request->page) ? $request->page : '1';
        //jumlah image yang di show per-halaman
        $limit = 6;
        $collection = $this->imageMuseum->getMuseumCollectionById($namamuseum)->get();

        $paginated_collection = $this->imageMuseum->paginate($page , $collection , $limit);

        //ambil gambar dalam bentuk koleksi
        $img = $paginated_collection['sliced_collection'];
        //button status
        $prev_button = $paginated_collection['prev_button'];
        $next_button = $paginated_collection['next_button'];
        //ambil nomor page
        $newpage = $paginated_collection['page'];
        //dd($img);

        return view('museum1.subwebsite.collections.collection')
        ->with('gambar',$img)
        ->with('page',$newpage)
        ->with('prev',$prev_button)
        ->with('next',$next_button)
        ->with('museum',$namamuseum);
    }

    public function subindex()
    {
        return view('museum1.subwebsite.collections.collectiontype');
    }


}
